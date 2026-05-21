<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `climbing_prices` table that stores editable pricing rows
     * for the climbing-wall (Lezecká stěna) section.
     */
    public function up(): void
    {
        Schema::create('climbing_prices', function (Blueprint $table): void {
            $table->id();
            $table->string('category');
            $table->string('name');
            $table->string('price');
            $table->string('unit')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Drop the `climbing_prices` table.
     */
    public function down(): void
    {
        Schema::dropIfExists('climbing_prices');
    }
};
