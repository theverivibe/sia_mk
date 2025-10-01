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
    ];

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

    /**
     * Role checking methods
     */
    public function isStaffIT(): bool
    {
        return $this->role === 'staff_it';
    }

    public function isPrincipal(): bool
    {
        return $this->role === 'principal';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Get assets assigned to this user
     */
    public function assignedAssets()
    {
        return $this->hasMany(Asset::class, 'assigned_to');
    }

    /**
     * Get complaints created by this user
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'user_id');
    }

    /**
     * Get complaints assigned to this user (for staff_it)
     */
    public function assignedComplaints()
    {
        return $this->hasMany(Complaint::class, 'assigned_to');
    }
}
