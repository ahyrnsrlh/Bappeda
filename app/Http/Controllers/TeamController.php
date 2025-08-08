<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    /**
     * Display the teams index page
     */
    public function index()
    {
        // Hitung jumlah file per tim
        $teamCounts = [];
        $teams = ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5'];
        
        foreach ($teams as $team) {
            // Ambil user yang memiliki role tim tersebut
            $teamUsers = User::where('role', $team)->pluck('id');
            // Hitung file yang diupload oleh user tim tersebut
            $teamCounts[$team] = File::whereIn('uploaded_by', $teamUsers)->count();
        }
        
        return Inertia::render('Teams/Index', [
            'teamCounts' => $teamCounts
        ]);
    }
    
    /**
     * Display files for a specific team
     */
    public function files(Request $request, $team)
    {
        // Validasi team yang valid
        $validTeams = ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5'];
        
        if (!in_array($team, $validTeams)) {
            abort(404);
        }
            
        return Inertia::render('Teams/Files', [
            'team' => $team
        ]);
    }
    
    /**
     * Display specific folder for a team
     */
    public function showFolder(Request $request, $team, $folder)
    {
        // Validasi team yang valid
        $validTeams = ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5'];
        $validFolders = ['data', 'notulen'];
        
        if (!in_array($team, $validTeams) || !in_array($folder, $validFolders)) {
            abort(404);
        }
        
        // Ambil user dari tim tersebut
        $teamUsers = User::where('role', $team)->pluck('id');
        
        // Ambil file yang diupload oleh tim tersebut berdasarkan folder
        $files = File::with('uploader')
            ->whereIn('uploaded_by', $teamUsers)
            ->where('folder_type', $folder)
            ->latest()
            ->get();
            
        return Inertia::render('Teams/Folder', [
            'files' => $files,
            'team' => $team,
            'folder' => $folder
        ]);
    }
}
