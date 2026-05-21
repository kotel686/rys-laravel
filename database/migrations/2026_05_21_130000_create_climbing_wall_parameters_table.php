<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `climbing_wall_parameters` table for the editable
     * label/value rows shown in the "Parametry stěny" card on O stěně.
     */
    public function up(): void
    {
        Schema::create('climbing_wall_parameters', function (Blueprint $table): void {
            $table->id();
            $table->string('label');
            $table->string('value');
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Drop the `climbing_wall_parameters` table.
     */
    public function down(): void
    {
        Schema::dropIfExists('climbing_wall_parameters');
    }
};
