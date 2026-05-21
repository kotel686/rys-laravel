<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the `climbing_team_members` table that stores team member
     * cards shown on the O stěně page.
     */
    public function up(): void
    {
        Schema::create('climbing_team_members', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->text('bio')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Drop the `climbing_team_members` table.
     */
    public function down(): void
    {
        Schema::dropIfExists('climbing_team_members');
    }
};
