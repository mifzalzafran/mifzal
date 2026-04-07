<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'category_id', 
        'room_id', 
        'requested_by', 
        'approved_by', 
        'start_datetime', 
        'end_datetime', 
        'status', 
        'rejection_reason', 
        'target_audience', 
        'report_notes'
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime'   => 'datetime',
    ];

    // --- RELASI (TETAP DIJAGA) ---

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function attachments()
    {
        return $this->hasMany(EventAttachment::class);
    }

    public function rsvps()
    {
        return $this->hasMany(Rsvp::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(EventSubscription::class);
    }

    // --- LOGIC HELPERS (TETAP DIJAGA) ---

    // Cek apakah user sudah RSVP
    public function userRsvp($userId)
    {
        return $this->rsvps()->where('user_id', $userId)->first();
    }

    // Cek apakah user sudah subscribe
    public function isSubscribedBy($userId)
    {
        return $this->subscriptions()->where('user_id', $userId)->exists();
    }
}