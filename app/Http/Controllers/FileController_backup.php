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
            $user = Auth::user();
            $teams = Team::all();
            
            // Convert team code to team ID if provided
            if ($request->team_id && !is_numeric($request->team_id)) {
                $team = Team::where('code', $request->team_id)->first();
                if ($team) {
                    $request->merge(['team_id' => $team->id]);
                }
            }

            $query = File::with(['uploadedBy', 'team']);
            
            // Apply filters
            if ($request->team_id) {
                $query->where('team_id', $request->team_id);
            }
            
            if ($request->type) {
                $query->where('type', $request->type);
            }
            
            if ($request->search) {
                $searchTerm = trim($request->search);
                if ($searchTerm) {
                    $query->where(function($q) use ($searchTerm) {
                        $q->where('original_name', 'like', '%' . $searchTerm . '%')
                          ->orWhere('description', 'like', '%' . $searchTerm . '%')
                          ->orWhereHas('uploadedBy', function($userQuery) use ($searchTerm) {
                              $userQuery->where('name', 'like', '%' . $searchTerm . '%');
                          })
                          ->orWhereHas('team', function($teamQuery) use ($searchTerm) {
                              $teamQuery->where('name', 'like', '%' . $searchTerm . '%');
                          });
                    });
                }
            }
            
            $files = $query->orderBy('created_at', 'desc')->paginate(10);
            
            return Inertia::render('Files/Index', [
                'files' => $files,
                'teams' => $teams,
                'filters' => [
                    'search' => $request->search,
                    'team_id' => $request->team_id,
                    'type' => $request->type,
                ],
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error in FileController@index: ' . $e->getMessage());
            return Inertia::render('Files/Index', [
                'files' => ['data' => []],
                'teams' => [],
                'error' => 'Terjadi kesalahan saat memuat file'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $user = Auth::user();
            $teams = Team::all();
            
            // For team users, filter to only show their own team
            if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5', 'tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'])) {
                // Get user's team
                $userTeamId = null;
                if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5'])) {
                    $roleToTeamMapping = [
                        'tim_1' => 'tim_kemiskinan',
                        'tim_2' => 'tim_industri_psn', 
                        'tim_3' => 'tim_investasi',
                        'tim_4' => 'tim_csr',
                        'tim_5' => 'tim_dbh'
                    ];
                    $teamCode = $roleToTeamMapping[$user->role] ?? null;
                    if ($teamCode) {
                        $userTeam = Team::where('code', $teamCode)->first();
                        $userTeamId = $userTeam ? $userTeam->id : null;
                    }
                } else if (in_array($user->role, ['tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'])) {
                    $userTeam = Team::where('code', $user->role)->first();
                    $userTeamId = $userTeam ? $userTeam->id : null;
                } else if ($user->team_id) {
                    $userTeamId = $user->team_id;
                }
                
                // Filter teams to only include user's team
                if ($userTeamId) {
                    $teams = $teams->where('id', $userTeamId);
                }
            }
            
            $selectedTeamId = null;
            if ($request->team_id) {
                $selectedTeamId = $request->team_id;
            } else if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5'])) {
                // Auto-select team for legacy team users
                $roleToTeamMapping = [
                    'tim_1' => 'tim_kemiskinan',
                    'tim_2' => 'tim_industri_psn', 
                    'tim_3' => 'tim_investasi',
                    'tim_4' => 'tim_csr',
                    'tim_5' => 'tim_dbh'
                ];
                $teamCode = $roleToTeamMapping[$user->role] ?? null;
                if ($teamCode) {
                    $team = Team::where('code', $teamCode)->first();
                    $selectedTeamId = $team ? $team->id : null;
                }
            } else if (in_array($user->role, ['tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'])) {
                // Auto-select team for new format team users
                $team = Team::where('code', $user->role)->first();
                $selectedTeamId = $team ? $team->id : null;
            } else if ($user->team_id) {
                // Fallback to user's direct team_id
                $selectedTeamId = $user->team_id;
            }
            
            return Inertia::render('Files/Create', [
                'teams' => $teams,
                'selectedTeam' => $selectedTeamId,
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
            Log::info('FileController@store called', [
                'user_id' => Auth::id(),
                'user_role' => Auth::user()->role,
                'request_data' => $request->except(['file', 'attachments']),
                'has_file' => $request->hasFile('file'),
                'has_attachments' => $request->hasFile('attachments')
            ]);
            
            // Check if this is a notulen upload
            if ($request->folder_type === 'notulen' && $request->has('title')) {
                // Notulen upload validation
                $request->validate([
                    'title' => 'required|string|max:255',
                    'content' => 'required|string',
                    'team_id' => 'required|exists:teams,id',
                    'attachments' => 'nullable|array',
                    'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,zip,rar|max:10240'
                ]);
                
                // Handle team assignment for notulen
                $teamId = $request->team_id;
                $user = Auth::user();
                
                // For team users, validate that they can only upload to their own team
                if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5', 'tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'])) {
                    // Get user's allowed team
                    $userTeamId = null;
                    if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5'])) {
                        $roleToTeamMapping = [
                            'tim_1' => 'tim_kemiskinan',
                            'tim_2' => 'tim_industri_psn', 
                            'tim_3' => 'tim_investasi',
                            'tim_4' => 'tim_csr',
                            'tim_5' => 'tim_dbh'
                        ];
                        $teamCode = $roleToTeamMapping[$user->role] ?? null;
                        if ($teamCode) {
                            $userTeam = Team::where('code', $teamCode)->first();
                            $userTeamId = $userTeam ? $userTeam->id : null;
                        }
                    } else if (in_array($user->role, ['tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'])) {
                        $userTeam = Team::where('code', $user->role)->first();
                        $userTeamId = $userTeam ? $userTeam->id : null;
                    } else if ($user->team_id) {
                        $userTeamId = $user->team_id;
                    }
                    
                    // If team_id is provided, validate it's the user's team
                    if ($teamId && $teamId != $userTeamId) {
                        return back()->withErrors(['team_id' => 'Anda hanya dapat mengupload notulen ke tim Anda sendiri.'])->withInput();
                    }
                    
                    // If no team_id provided, use user's team
                    if (!$teamId) {
                        $teamId = $userTeamId;
                    }
                } else {
                    // For KI users, if no team_id provided, try to get it from user's role
                    if (!$teamId) {
                        $teamId = $user->team_id;
                    }
                }
                
                // Create MeetingNote
                $meetingNote = \App\Models\MeetingNote::create([
                    'title' => $request->title,
                    'content' => $request->content,
                    'team_id' => $teamId,
                    'user_id' => Auth::id()
                ]);
                
                // Handle file attachments for notulen
                if ($request->hasFile('attachments')) {
                    foreach ($request->file('attachments') as $attachment) {
                        $fileName = time() . '_' . Str::random(10) . '.' . $attachment->getClientOriginalExtension();
                        $filePath = $attachment->storeAs('files/notulen', $fileName, 'public');
                        
                        File::create([
                            'original_name' => $attachment->getClientOriginalName(),
                            'file_path' => $filePath,
                            'file_size' => $attachment->getSize(),
                            'mime_type' => $attachment->getMimeType(),
                            'uploaded_by' => Auth::id(),
                            'team_id' => $teamId,
                            'type' => 'meeting_note',
                            'meeting_note_id' => $meetingNote->id
                        ]);
                    }
                }
                
                return redirect()->route('files.index')->with('success', 'Notulen rapat berhasil dibuat.');
            }
            
            // Regular file upload
            $request->validate([
                'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png,zip,rar|max:10240',
                'team_id' => 'required|exists:teams,id',
                'folder_type' => 'required|in:data,notulen',
                'description' => 'nullable|string|max:500'
            ]);
            
            $user = Auth::user();
            $teamId = $request->team_id;
            
            // For team users, validate that they can only upload to their own team
            if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5', 'tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'])) {
                // Get user's allowed team
                $userTeamId = null;
                if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5'])) {
                    $roleToTeamMapping = [
                        'tim_1' => 'tim_kemiskinan',
                        'tim_2' => 'tim_industri_psn', 
                        'tim_3' => 'tim_investasi',
                        'tim_4' => 'tim_csr',
                        'tim_5' => 'tim_dbh'
                    ];
                    $teamCode = $roleToTeamMapping[$user->role] ?? null;
                    if ($teamCode) {
                        $userTeam = Team::where('code', $teamCode)->first();
                        $userTeamId = $userTeam ? $userTeam->id : null;
                    }
                } else if (in_array($user->role, ['tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'])) {
                    $userTeam = Team::where('code', $user->role)->first();
                    $userTeamId = $userTeam ? $userTeam->id : null;
                } else if ($user->team_id) {
                    $userTeamId = $user->team_id;
                }
                
                // If team_id is provided, validate it's the user's team
                if ($teamId && $teamId != $userTeamId) {
                    return back()->withErrors(['team_id' => 'Anda hanya dapat mengupload file ke tim Anda sendiri.'])->withInput();
                }
                
                // If no team_id provided, use user's team
                if (!$teamId) {
                    $teamId = $userTeamId;
                }
            }
            
            $file = $request->file('file');
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('files/' . $request->folder_type, $fileName, 'public');
            
            File::create([
                'original_name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'uploaded_by' => Auth::id(),
                'team_id' => $teamId,
                'type' => $request->folder_type === 'notulen' ? 'meeting_note' : 'document',
                'description' => $request->description
            ]);
            
            return redirect()->route('files.index')->with('success', 'File berhasil diupload.');
            
        } catch (\Exception $e) {
            Log::error('Error in FileController@store: ' . $e->getMessage());
            return back()->withErrors(['file' => 'Terjadi kesalahan saat mengupload file.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        return Inertia::render('Files/Show', [
            'file' => $file->load(['uploadedBy', 'team'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        $teams = Team::all();
        
        return Inertia::render('Files/Edit', [
            'file' => $file->load(['uploadedBy', 'team']),
            'teams' => $teams
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        $request->validate([
            'original_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'team_id' => 'required|exists:teams,id'
        ]);
        
        $file->update([
            'original_name' => $request->original_name,
            'description' => $request->description,
            'team_id' => $request->team_id
        ]);
        
        return redirect()->route('files.index')->with('success', 'File berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $user = Auth::user();
        
        // KI has full access to delete any file
        if ($user->role === 'KI') {
            // Delete physical file
            if (Storage::disk('public')->exists($file->file_path)) {
                Storage::disk('public')->delete($file->file_path);
            }
            
            $file->delete();
            return redirect()->route('files.index')->with('success', 'File berhasil dihapus.');
        }
        
        // Kabid can only view, not delete
        if ($user->role === 'kabid') {
            abort(403, 'Anda tidak memiliki izin untuk menghapus file.');
        }
        
        // For team users, check if file belongs to their team
        if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5', 'tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'])) {
            // Get user's team ID
            $userTeamId = null;
            
            if (in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5'])) {
                $roleToTeamMapping = [
                    'tim_1' => 'tim_kemiskinan',
                    'tim_2' => 'tim_industri_psn', 
                    'tim_3' => 'tim_investasi',
                    'tim_4' => 'tim_csr',
                    'tim_5' => 'tim_dbh'
                ];
                $teamCode = $roleToTeamMapping[$user->role] ?? null;
                if ($teamCode) {
                    $userTeam = Team::where('code', $teamCode)->first();
                    $userTeamId = $userTeam ? $userTeam->id : null;
                }
            } else if (in_array($user->role, ['tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'])) {
                $userTeam = Team::where('code', $user->role)->first();
                $userTeamId = $userTeam ? $userTeam->id : null;
            } else if ($user->team_id) {
                $userTeamId = $user->team_id;
            }
            
            // Check if file belongs to user's team
            if ($file->team_id !== $userTeamId) {
                abort(403, 'Anda hanya dapat menghapus file dari tim Anda sendiri.');
            }
        }
        
        // Additional check: only file uploader or team member can delete
        if ($file->uploaded_by !== $user->id && !in_array($user->role, ['KI'])) {
            // For team files, allow team members to delete if it's their team's file
            if (!in_array($user->role, ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5', 'tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'])) {
                abort(403, 'Anda tidak memiliki izin untuk menghapus file ini.');
            }
        }
        
        // Delete physical file
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
        }
        
        $file->delete();

        return redirect()->route('files.index')->with('success', 'File berhasil dihapus.');
    }

    /**
     * Download the specified file.
     */
    public function download(File $file)
    {
        if (!Storage::disk('public')->exists($file->file_path)) {
            abort(404, 'File tidak ditemukan');
        }
        
        return Storage::disk('public')->download($file->file_path, $file->original_name);
    }
}
