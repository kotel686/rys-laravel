<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

/**
 * Provision the initial Filament admin user from environment variables.
 *
 * Reads ADMIN_NAME, ADMIN_EMAIL and ADMIN_PASSWORD from the environment so
 * that credentials are never committed to the repository. The password is
 * stored hashed (bcrypt) and the email is automatically added to the
 * ADMIN_EMAILS allow-list at runtime.
 */
class AdminUserSeeder extends Seeder
{
    /**
     * Minimum admin password length (matches a sensible OWASP baseline).
     */
    private const MIN_PASSWORD_LENGTH = 12;

    /**
     * Run the seeder.
     *
     * @throws RuntimeException When the required env variables are missing
     *                          or the password is too weak.
     */
    public function run(): void
    {
        $email = (string) env('ADMIN_EMAIL', '');
        $password = (string) env('ADMIN_PASSWORD', '');
        $name = (string) env('ADMIN_NAME', 'Administrátor');

        if ($email === '' || $password === '') {
            $this->command?->warn(
                'AdminUserSeeder skipped: set ADMIN_EMAIL and ADMIN_PASSWORD in .env first.'
            );

            return;
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException('ADMIN_EMAIL is not a valid email address.');
        }

        if (mb_strlen($password) < self::MIN_PASSWORD_LENGTH) {
            throw new RuntimeException(sprintf(
                'ADMIN_PASSWORD must be at least %d characters long.',
                self::MIN_PASSWORD_LENGTH,
            ));
        }

        User::query()->updateOrCreate(
            ['email' => mb_strtolower($email)],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ],
        );

        $this->command?->info("Admin user provisioned: {$email}");
    }
}
