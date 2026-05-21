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
 * @property string $source
 * @property string|null $ip_address
 * @property \Illuminate\Support\Carbon|null $handled_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
#[Fillable(['name', 'email', 'phone', 'message', 'source', 'ip_address', 'handled_at'])]
class ContactMessage extends Model
{
    /**
     * Allowed source values. Anything else is rejected by validation and
     * coerced to `vyskoveprace` here as a defence-in-depth.
     */
    public const SOURCE_VYSKOVEPRACE = 'vyskoveprace';

    public const SOURCE_CLIMBING = 'lezeckastena';

    /**
     * Human-readable label for the message's source.
     */
    public function sourceLabel(): string
    {
        return match ($this->source) {
            self::SOURCE_CLIMBING => 'Lezecká stěna',
            default => 'Výškové práce',
        };
    }

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
