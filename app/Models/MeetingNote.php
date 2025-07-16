<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_schedule_id',
        'title',
        'content',
        'decisions',
        'action_items',
        'attendees',
        'file_path',
        'is_archived',
        'created_by',
    ];

    protected $casts = [
        'attendees' => 'array',
        'is_archived' => 'boolean',
    ];

    /**
     * Get the meeting schedule that the note belongs to.
     */
    public function meetingSchedule()
    {
        return $this->belongsTo(MeetingSchedule::class);
    }

    /**
     * Get the user who created the note.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who created the note (alias).
     */
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the file attachments for the note.
     */
    public function attachments()
    {
        return $this->hasMany(File::class);
    }

    /**
     * Get the file URL if exists.
     */
    public function getFileUrlAttribute()
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }
}
