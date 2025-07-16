<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class MeetingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'agenda',
        'description',
        'meeting_date',
        'location',
        'status',
        'created_by',
    ];

    protected $casts = [
        'meeting_date' => 'datetime',
    ];

    /**
     * Get the user who created the meeting schedule.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the meeting notes for this schedule.
     */
    public function notes()
    {
        return $this->hasMany(MeetingNote::class);
    }

    /**
     * Get formatted meeting date.
     */
    public function getFormattedDateAttribute()
    {
        return $this->meeting_date->format('d F Y, H:i');
    }

    /**
     * Check if meeting is upcoming.
     */
    public function isUpcoming()
    {
        return $this->meeting_date > now() && $this->status === 'scheduled';
    }

    /**
     * Check if meeting is past.
     */
    public function isPast()
    {
        return $this->meeting_date < now();
    }
}
