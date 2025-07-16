<?php

namespace App\Http\Controllers;

use App\Models\MeetingSchedule;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MeetingScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        $query = MeetingSchedule::with(['creator', 'notes']);
        
        // KI only sees meetings they created
        if ($user->role === 'KI') {
            $query->where('created_by', $user->id);
        }
        
        $meetings = $query->orderBy('meeting_date', 'desc')->paginate(10);
        
        return Inertia::render('Meetings/Index', [
            'meetings' => $meetings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::all();
        
        return Inertia::render('Meetings/Create', [
            'teams' => $teams,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'agenda' => 'nullable|string',
            'meeting_date' => 'required|date|after:now',
            'location' => 'nullable|string|max:255',
            'participant_teams' => 'nullable|array',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        MeetingSchedule::create([
            'title' => $request->title,
            'agenda' => $request->agenda,
            'meeting_date' => $request->meeting_date,
            'location' => $request->location,
            'participant_teams' => $request->participant_teams,
            'status' => $request->status,
            'notes' => $request->notes,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('meetings.index')
            ->with('success', 'Jadwal rapat berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MeetingSchedule $meeting)
    {
        $meeting->load(['creator']);
        $meetingNotes = \App\Models\MeetingNote::where('meeting_schedule_id', $meeting->id)
            ->with(['createdByUser', 'attachments'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $teams = Team::all();
        
        return Inertia::render('Meetings/Show', [
            'meeting' => $meeting,
            'meetingNotes' => $meetingNotes,
            'teams' => $teams,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MeetingSchedule $meeting)
    {
        // Only creator can edit
        if ($meeting->created_by !== Auth::id()) {
            abort(403);
        }
        
        $teams = Team::all();
        
        return Inertia::render('Meetings/Edit', [
            'meeting' => $meeting,
            'teams' => $teams,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MeetingSchedule $meeting)
    {
        // Only creator can update
        if ($meeting->created_by !== Auth::id()) {
            abort(403);
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'agenda' => 'nullable|string',
            'description' => 'nullable|string',
            'meeting_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        $meeting->update($request->all());

        return redirect()->route('meetings.index')
            ->with('message', 'Jadwal rapat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeetingSchedule $meeting)
    {
        // Only creator can delete
        if ($meeting->created_by !== Auth::id()) {
            abort(403);
        }
        
        $meeting->delete();

        return redirect()->route('meetings.index')
            ->with('message', 'Jadwal rapat berhasil dihapus.');
    }
}
