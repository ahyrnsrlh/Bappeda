<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'team_id',
    ];

    /**
     * Get the team that the user belongs to.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the files uploaded by the user.
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }

    /**
     * Get the meeting schedules created by the user.
     */
    public function createdMeetingSchedules()
    {
        return $this->hasMany(MeetingSchedule::class, 'created_by');
    }

    /**
     * Get the meeting notes created by the user.
     */
    public function createdMeetingNotes()
    {
        return $this->hasMany(MeetingNote::class, 'created_by');
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Check if user is Kepala Bidang.
     */
    public function isKabid()
    {
        return $this->role === 'kabid';
    }

    /**
     * Check if user is Konsultan Individu.
     */
    public function isKI()
    {
        return $this->role === 'KI';
    }

    /**
     * Check if user is Tim Kerja.
     */
    public function isTimKerja()
    {
        return str_starts_with($this->role, 'tim_');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
