<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'status',
        'last_login_at',
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
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'status' => UserStatus::class,
        ];
    }

    /**
     * Client profile relationship.
     */
    public function clientProfile(): HasOne
    {
        return $this->hasOne(ClientProfile::class, 'user_id');
    }

    /**
     * Check if user has administrative privileges (admin or super_admin).
     */
    public function isAdmin(): bool
    {
        return $this->role instanceof UserRole
            ? $this->role->isAdminRole()
            : in_array($this->role, [UserRole::ADMIN->value, UserRole::SUPER_ADMIN->value], true);
    }

    /**
     * Check if user is a client account.
     */
    public function isClient(): bool
    {
        return $this->role instanceof UserRole
            ? $this->role->isClientRole()
            : $this->role === UserRole::CLIENT->value;
    }

    /**
     * Check if user account is active.
     */
    public function isActive(): bool
    {
        return $this->status instanceof UserStatus
            ? $this->status === UserStatus::ACTIVE
            : $this->status === UserStatus::ACTIVE->value;
    }

    /**
     * Determine if the user has any of the specified roles.
     */
    public function hasRole(UserRole|string ...$roles): bool
    {
        $userRoleValue = $this->role instanceof UserRole ? $this->role->value : (string) $this->role;

        foreach ($roles as $role) {
            $checkValue = $role instanceof UserRole ? $role->value : (string) $role;
            if ($userRoleValue === $checkValue) {
                return true;
            }
            if ($checkValue === 'admin' && $this->isAdmin()) {
                return true;
            }
        }

        return false;
    }
}
