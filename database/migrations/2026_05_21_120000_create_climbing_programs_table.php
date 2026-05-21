<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `climbing_programs` table that stores the editable
     * program cards shown on the Kroužky a oddíl page.
     */
    public function up(): void
    {
        Schema::create('climbing_programs', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description');
            $table->json('bullets')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Drop the `climbing_programs` table.
     */
    public function down(): void
    {
        Schema::dropIfExists('climbing_programs');
    }
};
