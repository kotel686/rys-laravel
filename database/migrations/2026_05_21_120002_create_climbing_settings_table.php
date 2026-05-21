<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `climbing_settings` key-value table for free-text
     * snippets shown on the climbing-wall mini-site (intro story, etc.).
     */
    public function up(): void
    {
        Schema::create('climbing_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique();
            $table->string('label');
            $table->longText('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Drop the `climbing_settings` table.
     */
    public function down(): void
    {
        Schema::dropIfExists('climbing_settings');
    }
};
