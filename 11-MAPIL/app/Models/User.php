<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'photo',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function events()
    {
        return $this->hasMany(Event::class, 'requested_by');
    }

    public function rsvps()
    {
        return $this->hasMany(Rsvp::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(EventSubscription::class);
    }

    // FUNGSI CEK ROLE (MENGGUNAKAN SPATIE HASROLE)
    public function isAdmin()  { return $this->hasRole('admin'); }
    public function isGuru()   { return $this->hasRole('guru'); }
    public function isSiswa()  { return $this->hasRole('siswa'); }
}