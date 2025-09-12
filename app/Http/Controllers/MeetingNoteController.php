<?php

namespace App\Http\Controllers;

use App\Models\MeetingNote;
use App\Models\MeetingSchedule;
use App\Models\File;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MeetingNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = MeetingNote::with(['meetingSchedule', 'createdByUser'])
            ->withCount('attachments')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        $meetings = MeetingSchedule::orderBy('meeting_date', 'desc')->get();
            
        return Inertia::render('MeetingNotes/Index', [
            'notes' => $notes,
            'meetings' => $meetings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Only KI can create meeting notes
        if (Auth::user()->role !== 'KI') {
            abort(403, 'Anda tidak memiliki izin untuk membuat notulen rapat.');
        }
        
        $meetings = MeetingSchedule::orderBy('meeting_date', 'desc')->get();
        $selectedMeetingId = $request->get('meeting_id');
        
        return Inertia::render('MeetingNotes/Create', [
            'meetings' => $meetings,
            'selectedMeetingId' => $selectedMeetingId,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only KI can create meeting notes
        if (Auth::user()->role !== 'KI') {
            abort(403, 'Anda tidak memiliki izin untuk membuat notulen rapat.');
        }
        
        $request->validate([
            'meeting_schedule_id' => 'required|exists:meeting_schedules,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachments.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif|max:10240',
            'is_archived' => 'boolean',
        ]);

        $note = MeetingNote::create([
            'meeting_schedule_id' => $request->meeting_schedule_id,
            'title' => $request->title,
            'content' => $request->content,
            'created_by' => Auth::id(),
            'is_archived' => $request->boolean('is_archived'),
        ]);

        // Handle file attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('meeting-notes', $filename, 'public');

                File::create([
                    'original_name' => $file->getClientOriginalName(),
                    'filename' => $filename,
                    'file_path' => $path,
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'uploaded_by' => Auth::id(),
                    'team_id' => Auth::user()->team_id,
                    'meeting_note_id' => $note->id,
                ]);
            }
        }

        return redirect()->route('meeting-notes.index')
            ->with('success', 'Notulen berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MeetingNote $note)
    {
        $note->load(['meetingSchedule', 'createdByUser', 'attachments']);
        
        return Inertia::render('MeetingNotes/Show', [
            'note' => $note,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MeetingNote $note)
    {
        // Check if user can edit this note - only creator or KI
        if ($note->created_by !== Auth::id() && Auth::user()->role !== 'KI') {
            abort(403, 'Anda tidak memiliki izin untuk mengedit notulen ini.');
        }
        
        $meetings = MeetingSchedule::orderBy('meeting_date', 'desc')->get();
        $note->load('attachments');
        
        return Inertia::render('MeetingNotes/Edit', [
            'note' => $note,
            'meetings' => $meetings,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MeetingNote $note)
    {
        // Check if user can edit this note - only creator or KI
        if ($note->created_by !== Auth::id() && Auth::user()->role !== 'KI') {
            abort(403, 'Anda tidak memiliki izin untuk mengedit notulen ini.');
        }
        
        $request->validate([
            'meeting_schedule_id' => 'required|exists:meeting_schedules,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachments.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,gif|max:10240',
            'is_archived' => 'boolean',
        ]);

        $note->update([
            'meeting_schedule_id' => $request->meeting_schedule_id,
            'title' => $request->title,
            'content' => $request->content,
            'is_archived' => $request->boolean('is_archived'),
        ]);

        // Handle new file attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('meeting-notes', $filename, 'public');

                File::create([
                    'original_name' => $file->getClientOriginalName(),
                    'filename' => $filename,
                    'file_path' => $path,
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'uploaded_by' => Auth::id(),
                    'team_id' => Auth::user()->team_id,
                    'meeting_note_id' => $note->id,
                ]);
            }
        }

        return redirect()->route('meeting-notes.index')
            ->with('success', 'Notulen berhasil diperbarui.');
    }

    /**
     * Toggle archive status of the specified resource.
     */
    public function toggleArchive(Request $request, MeetingNote $note)
    {
        // Check if user can archive this note - only KI
        if (Auth::user()->role !== 'KI') {
            abort(403, 'Anda tidak memiliki izin untuk mengarsipkan notulen.');
        }
        
        $request->validate([
            'is_archived' => 'required|boolean',
        ]);

        $note->update([
            'is_archived' => $request->boolean('is_archived'),
        ]);

        $message = $request->boolean('is_archived') ? 
            'Notulen berhasil diarsipkan.' : 
            'Notulen berhasil diaktifkan.';

        return back()->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeetingNote $note)
    {
        // Check if user can delete this note
        if ($note->created_by !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Delete associated files
        $attachments = $note->attachments;
        foreach ($attachments as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
            $attachment->delete();
        }

        $note->delete();

        return redirect()->route('meeting-notes.index')
            ->with('success', 'Notulen berhasil dihapus.');
    }
}
