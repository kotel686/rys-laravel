<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `climbing_payments` table that stores QR-payment cards
     * shown on the Ceník page (typically one per bank account / purpose).
     */
    public function up(): void
    {
        Schema::create('climbing_payments', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Drop the `climbing_payments` table.
     */
    public function down(): void
    {
        Schema::dropIfExists('climbing_payments');
    }
};
