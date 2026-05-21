<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `climbing_equipment_items` table for the editable bullet
     * list shown in the "Vybavení" card on O stěně.
     */
    public function up(): void
    {
        Schema::create('climbing_equipment_items', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Drop the `climbing_equipment_items` table.
     */
    public function down(): void
    {
        Schema::dropIfExists('climbing_equipment_items');
    }
};
