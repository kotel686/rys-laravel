<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Authenticatable user. Access to the Filament admin panel is restricted
 * to addresses listed in the ADMIN_EMAILS env variable.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 */
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Attribute casts.
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
     * Allow only verified, allow-listed admins into the Filament panel.
     *
     * Allow-list is configured via the ADMIN_EMAILS env variable (comma
     * separated). Empty list = deny everyone (fail-closed).
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() !== 'admin') {
            return false;
        }

        if ($this->email_verified_at === null) {
            return false;
        }

        $allowed = collect(explode(',', (string) config('auth.admin_emails', '')))
            ->map(static fn (string $email): string => strtolower(trim($email)))
            ->filter()
            ->all();

        if ($allowed === []) {
            return false;
        }

        return in_array(strtolower($this->email), $allowed, true);
    }
}
