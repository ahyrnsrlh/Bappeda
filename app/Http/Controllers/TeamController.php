<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    /**
     * Display the teams index page
     */
    public function index()
    {
        // Hitung jumlah file per tim - using database team records
        $teamCounts = [];
        $teams = Team::all();
        
        foreach ($teams as $team) {
            // Hitung file yang diupload untuk tim tersebut berdasarkan team_id
            $teamCounts[$team->code] = File::where('team_id', $team->id)->count();
        }
        
        return Inertia::render('Teams/Index', [
            'teamCounts' => $teamCounts,
            'teams' => $teams
        ]);
    }
    
    /**
     * Display files for a specific team
     */
    public function files(Request $request, $team)
    {
        // Validasi team yang valid - support both legacy and new codes
        $validTeams = ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5', 'tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'];
        
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
        // Validasi team yang valid - support both legacy and new codes
        $validTeams = ['tim_1', 'tim_2', 'tim_3', 'tim_4', 'tim_5', 'tim_kemiskinan', 'tim_industri_psn', 'tim_investasi', 'tim_csr', 'tim_dbh'];
        $validFolders = ['data', 'notulen'];
        
        if (!in_array($team, $validTeams) || !in_array($folder, $validFolders)) {
            abort(404);
        }
        
        // Cari team berdasarkan code - try new code first, then legacy mapping
        $teamData = Team::where('code', $team)->first();
        
        // If not found and it's a legacy code, map to new code
        if (!$teamData) {
            $legacyMapping = [
                'tim_1' => 'tim_kemiskinan',
                'tim_2' => 'tim_industri_psn', 
                'tim_3' => 'tim_investasi',
                'tim_4' => 'tim_csr',
                'tim_5' => 'tim_dbh'
            ];
            
            if (isset($legacyMapping[$team])) {
                $teamData = Team::where('code', $legacyMapping[$team])->first();
            }
        }
        
        if (!$teamData) {
            abort(404);
        }
        
        // Ambil file yang diupload untuk tim tersebut berdasarkan folder
        $files = File::with('uploader')
            ->where('team_id', $teamData->id)
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
