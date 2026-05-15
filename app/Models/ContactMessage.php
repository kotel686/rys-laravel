<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

/**
 * A single submission of the public "Nezávazná poptávka" contact form.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $message
 * @property string|null $ip_address
 * @property \Illuminate\Support\Carbon|null $handled_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
#[Fillable(['name', 'email', 'phone', 'message', 'ip_address', 'handled_at'])]
class ContactMessage extends Model
{
    /**
     * Attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'handled_at' => 'datetime',
        ];
    }

    /**
     * Has this message already been processed by the admin?
     */
    public function isHandled(): bool
    {
        return $this->handled_at !== null;
    }
}
