<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            Log::info('FileController@index called', ['user_id' => Auth::id()]);
            
            $user = Auth::user();
            
            if (!$user) {
                Log::error('No authenticated user found');
                return redirect()->route('login');
            }
            
            Log::info('User authenticated', ['user_id' => $user->id, 'user_name' => $user->name]);
            
            $query = File::with(['uploadedBy', 'team']);
            
            // Filter berdasarkan role
            if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5'])) {
                // Tim kerja bisa melihat semua file tim kerja, bukan hanya milik mereka
                // Tidak ada filter khusus - mereka bisa lihat semua
            }
            // Kabid dan KI bisa melihat semua file
            
            // Apply filters
            if ($request->team_id) {
                $query->where('team_id', $request->team_id);
            }
            
            if ($request->type) {
                $query->where('type', $request->type);
            }
            
            if ($request->search) {
                $query->where(function($q) use ($request) {
                    $q->where('original_name', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            }
            
            $files = $query->orderBy('created_at', 'desc')->paginate(10);
            $teams = Team::all();
            
            Log::info('Files query executed', ['files_count' => $files->count()]);
            
            return Inertia::render('Files/Index', [
                'files' => $files,
                'teams' => $teams,
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error in FileController@index: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return Inertia::render('Files/Index', [
                'files' => collect([]),
                'teams' => [],
                'error' => 'Terjadi kesalahan saat memuat data files'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $teams = Team::all();
            
            return Inertia::render('Files/Create', [
                'teams' => $teams,
                'selectedTeam' => $request->team,
                'selectedFolder' => $request->folder,
            ]);
        } catch (\Exception $e) {
            Log::error('Error in FileController@create: ' . $e->getMessage());
            
            return Inertia::render('Files/Create', [
                'teams' => [],
                'error' => 'Terjadi kesalahan saat memuat halaman'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Check if this is a notulen upload
            if ($request->folder_type === 'notulen' && $request->has('title')) {
                // Notulen upload validation
                $request->validate([
                    'title' => 'required|string|max:255',
                    'content' => 'required|string',
                    'attachments' => 'nullable|array',
                    'attachments.*' => 'file|max:10240', // 10MB max per file
                    'team_id' => 'nullable|exists:teams,id',
                    'folder_type' => 'required|in:data,notulen',
                ]);

                $teamId = $request->team_id ?: Auth::user()->team_id;
                $uploadedFiles = [];

                // Handle file attachments if any
                if ($request->hasFile('attachments')) {
                    foreach ($request->file('attachments') as $file) {
                        $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                        $path = $file->storeAs('files', $filename, 'public');

                        $uploadedFile = File::create([
                            'original_name' => $file->getClientOriginalName(),
                            'filename' => $filename,
                            'file_path' => $path,
                            'file_size' => $file->getSize(),
                            'mime_type' => $file->getMimeType(),
                            'description' => "Lampiran notulen: " . $request->title,
                            'type' => 'document',
                            'folder_type' => 'notulen',
                            'uploaded_by' => Auth::id(),
                            'team_id' => $teamId,
                        ]);

                        $uploadedFiles[] = $uploadedFile;
                    }
                }

                // Create a main notulen file with content
                $contentFilename = time() . '_notulen_' . Str::slug($request->title) . '.txt';
                $contentPath = 'files/' . $contentFilename;
                
                // Save content as text file
                Storage::disk('public')->put($contentPath, 
                    "NOTULEN RAPAT\n" . 
                    "================\n\n" .
                    "Judul: " . $request->title . "\n" .
                    "Tanggal: " . now()->format('d F Y H:i') . "\n" .
                    "Dibuat oleh: " . Auth::user()->name . "\n\n" .
                    "ISI NOTULEN:\n" .
                    "============\n\n" .
                    $request->content . "\n\n" .
                    "Lampiran: " . count($uploadedFiles) . " file(s)"
                );

                $mainFile = File::create([
                    'original_name' => $request->title . '.txt',
                    'filename' => $contentFilename,
                    'file_path' => $contentPath,
                    'file_size' => strlen($request->content),
                    'mime_type' => 'text/plain',
                    'description' => $request->title,
                    'type' => 'document',
                    'folder_type' => 'notulen',
                    'uploaded_by' => Auth::id(),
                    'team_id' => $teamId,
                ]);

                return redirect()->route('files.index')
                    ->with('success', 'Notulen berhasil disimpan dengan ' . count($uploadedFiles) . ' lampiran.');

            } else {
                // Regular file upload validation
                $request->validate([
                    'file' => 'required|file|max:51200', // 50MB max (fixed from 10MB)
                    'description' => 'nullable|string|max:500',
                    'type' => 'required|in:document,meeting_note,other',
                    'team_id' => 'nullable|exists:teams,id',
                    'folder_type' => 'required|in:data,notulen',
                ]);

                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('files', $filename, 'public');

                File::create([
                    'original_name' => $file->getClientOriginalName(),
                    'filename' => $filename,
                    'file_path' => $path,
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'description' => $request->description,
                    'type' => $request->type,
                    'folder_type' => $request->folder_type,
                    'uploaded_by' => Auth::id(),
                    'team_id' => $request->team_id ?: Auth::user()->team_id,
                ]);

                // Redirect based on context
                if ($request->team && $request->folder_type) {
                    // Convert team role to team code for redirect
                    $teamCode = $request->team;
                    if (str_starts_with($teamCode, 'tim_')) {
                        return redirect()->route('teams.folders', [$teamCode, $request->folder_type])
                            ->with('success', 'File berhasil diunggah.');
                    }
                }

                return redirect()->route('files.index')
                    ->with('success', 'File berhasil diunggah.');
            }
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in FileController@store: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            Log::error('Error in FileController@store: ' . $e->getMessage());
            return back()->withErrors(['file' => 'Terjadi kesalahan saat mengupload file. Silakan coba lagi.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        $file->load(['uploadedBy', 'team']);
        
        return Inertia::render('Files/Show', [
            'file' => $file,
        ]);
    }

    /**
     * Download the specified file.
     */
    public function download(File $file)
    {
        $user = Auth::user();
        
        // Semua user bisa download file (kabid, KI, dan tim kerja)
        // Tidak ada pembatasan akses untuk download
        
        if (!Storage::disk('public')->exists($file->file_path)) {
            abort(404, 'File not found');
        }
        
        $filePath = Storage::disk('public')->path($file->file_path);
        
        return response()->download($filePath, $file->original_name);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        $user = Auth::user();
        
        // Tim kerja hanya bisa edit file mereka sendiri
        // KI bisa edit semua file
        if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5'])) {
            if ($file->uploaded_by !== $user->id) {
                abort(403, 'Anda hanya dapat mengedit file yang Anda upload sendiri');
            }
        }
        
        $teams = Team::all();
        
        return Inertia::render('Files/Edit', [
            'file' => $file,
            'teams' => $teams,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        // Only the uploader or KI can edit
        if ($file->uploaded_by !== Auth::id() && Auth::user()->role !== 'KI') {
            abort(403, 'Unauthorized');
        }
        
        $request->validate([
            'description' => 'nullable|string|max:500',
            'type' => 'required|in:document,meeting_note,other',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        $file->update([
            'description' => $request->description,
            'type' => $request->type,
            'team_id' => $request->team_id,
        ]);

        return redirect()->route('files.index')
            ->with('success', 'File berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $user = Auth::user();
        
        // Check if user can delete this file
        if ($file->uploaded_by !== $user->id && !in_array($user->role, ['KI', 'kabid'])) {
            abort(403, 'Unauthorized');
        }
        
        // Delete physical file
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }
        
        $file->delete();

        return redirect()->route('files.index')
            ->with('success', 'File berhasil dihapus.');
    }
}
