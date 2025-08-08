<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\MeetingSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get statistics based on role
        $stats = $this->getStatsForUser($user);
        
        // Get recent data
        $recentMeetings = $this->getRecentMeetings($user);
        $recentFiles = $this->getRecentFiles($user);
        
        return Inertia::render('Dashboard/Index', [
            'stats' => $stats,
            'recentMeetings' => $recentMeetings,
            'recentFiles' => $recentFiles,
        ]);
    }
    
    private function getStatsForUser($user)
    {
        $stats = [
            'totalMeetings' => 0,
            'totalFiles' => 0,
            'upcomingMeetings' => 0,
        ];
        
        if ($user->role === 'kabid') {
            // Kepala Bidang can see all data
            $stats['totalMeetings'] = MeetingSchedule::count();
            $stats['totalFiles'] = File::count();
            $stats['upcomingMeetings'] = MeetingSchedule::where('meeting_date', '>', now())
                ->where('status', 'scheduled')
                ->count();
        } elseif ($user->role === 'KI') {
            // Konsultan Individu can see their created meetings and all files
            $stats['totalMeetings'] = MeetingSchedule::where('created_by', $user->id)->count();
            $stats['totalFiles'] = File::count();
            $stats['upcomingMeetings'] = MeetingSchedule::where('created_by', $user->id)
                ->where('meeting_date', '>', now())
                ->where('status', 'scheduled')
                ->count();
        } else {
            // Tim Kerja can see all meetings and team files
            $stats['totalMeetings'] = MeetingSchedule::count();
            $stats['totalFiles'] = File::where('team_id', $user->team_id)->count();
            $stats['upcomingMeetings'] = MeetingSchedule::where('meeting_date', '>', now())
                ->where('status', 'scheduled')
                ->count();
        }
        
        return $stats;
    }
    
    private function getRecentMeetings($user)
    {
        $query = MeetingSchedule::with('creator');
        
        if ($user->role === 'KI') {
            $query->where('created_by', $user->id);
        }
        
        return $query->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }
    
    private function getRecentFiles($user)
    {
        $query = File::with('user');
        
        if ($user->role === 'tim_1' || $user->role === 'tim_2' || $user->role === 'tim_3' || 
            $user->role === 'tim_4' || $user->role === 'tim_5') {
            // Tim Kerja can see their team files and other teams' files
            // For now, show all files but prioritize their team's files
            $query->orderByRaw("CASE WHEN team_id = ? THEN 0 ELSE 1 END", [$user->team_id]);
        }
        
        return $query->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($file) {
                $file->formatted_size = $file->getFormattedSizeAttribute();
                return $file;
            });
    }
}
