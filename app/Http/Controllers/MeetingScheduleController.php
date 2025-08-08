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
        
        // Semua user bisa melihat semua meeting schedule
        // Tidak ada filter berdasarkan role untuk viewing
        
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
            'meeting_date' => 'required|date|after:now',
            'location' => 'nullable|string|max:255',
            'participant_teams' => 'nullable|array',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
            'invitation_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // 10MB
        ]);

        $meetingData = [
            'title' => $request->title,
            'meeting_date' => $request->meeting_date,
            'location' => $request->location,
            'participant_teams' => $request->participant_teams,
            'status' => $request->status,
            'notes' => $request->notes,
            'created_by' => Auth::id(),
        ];

        // Handle invitation file upload
        if ($request->hasFile('invitation_file')) {
            $file = $request->file('invitation_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('meeting-invitations', $fileName, 'public');
            
            $meetingData['invitation_file_path'] = $filePath;
            $meetingData['invitation_original_name'] = $file->getClientOriginalName();
            $meetingData['invitation_file_size'] = $file->getSize();
        }

        MeetingSchedule::create($meetingData);

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
