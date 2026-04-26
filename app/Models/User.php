<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, Billable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password',
        'country', 'phone', 'address', 'currency',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'trial_ends_at' => 'datetime',
        ];
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function disputes()
    {
        return $this->hasMany(Dispute::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole(['admin', 'editor']);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isEditor(): bool
    {
        return $this->hasRole('editor');
    }

    public function isCustomer(): bool
    {
        return $this->hasRole('customer');
    }
}
