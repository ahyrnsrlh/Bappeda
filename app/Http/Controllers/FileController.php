<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
                $query->where('team_id', $user->team_id);
            }
            
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
    public function create()
    {
        try {
            $teams = Team::all();
            
            return Inertia::render('Files/Create', [
                'teams' => $teams,
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
            $request->validate([
                'file' => 'required|file|max:51200', // 50MB max (fixed from 10MB)
                'description' => 'nullable|string|max:500',
                'type' => 'required|in:document,meeting_note,other',
                'team_id' => 'nullable|exists:teams,id',
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
                'uploaded_by' => Auth::id(),
                'team_id' => $request->team_id ?: Auth::user()->team_id,
            ]);

            return redirect()->route('files.index')
                ->with('success', 'File berhasil diunggah.');
                
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
        
        // Check if user can access this file
        if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5'])) {
            if ($file->team_id !== $user->team_id) {
                abort(403, 'Unauthorized access to file');
            }
        }
        
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
        // Only the uploader or KI can edit
        if ($file->uploaded_by !== Auth::id() && Auth::user()->role !== 'KI') {
            abort(403, 'Unauthorized');
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
