<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

<<<<<<< HEAD
class User extends Authenticatable
{
    use HasRoles;
    
    use HasFactory, Notifiable;
=======
class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
        ];
    }

<<<<<<< HEAD
    public function candidate(): HasOne
    {
        return $this->hasOne(Candidate::class);
    }}
=======
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->hasRole('admin');
        }

        if ($panel->getId() === 'candidate') {
            return $this->hasRole('candidate') && ! $this->hasRole('admin');
        }

        return false;
    }

    public function candidate(): HasOne
    {
        return $this->hasOne(Candidate::class);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isCandidate(): bool
    {
        return $this->hasRole('candidate');
    }
}
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
