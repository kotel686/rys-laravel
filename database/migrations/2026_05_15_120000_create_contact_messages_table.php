<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `contact_messages` table that stores submissions from the
     * public contact form. The admin reviews them in the Filament panel.
     */
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 190);
            $table->string('phone', 32)->nullable();
            $table->text('message');
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('handled_at')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Drop the `contact_messages` table.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
