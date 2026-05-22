<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `climbing_opening_hours` table that drives the
     * opening-hours block on /lezeckastena/kontakt and in the
     * shared climbing footer.
     */
    public function up(): void
    {
        Schema::create('climbing_opening_hours', function (Blueprint $table): void {
            $table->id();
            $table->string('day_label');
            $table->string('hours');
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Drop the `climbing_opening_hours` table.
     */
    public function down(): void
    {
        Schema::dropIfExists('climbing_opening_hours');
    }
};
