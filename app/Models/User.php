<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\LogsActivity;

class User extends Authenticatable
{

    use HasFactory, Notifiable;
    use LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone',
        'address',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Helper untuk cek role di Blade / Controller, contoh: $user->hasRole('admin')
    public function hasRole(string $slug): bool
    {
        return $this->role?->slug === $slug;
    }
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role?->slug, $roles, true);
    }
}