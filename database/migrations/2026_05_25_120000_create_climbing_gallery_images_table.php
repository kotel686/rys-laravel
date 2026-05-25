<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create the table that backs the PhotoSwipe gallery on the
     * /lezeckastena home page. Width/height are cached on upload so the
     * frontend can render the lightbox without first measuring the image.
     */
    public function up(): void
    {
        Schema::create('climbing_gallery_images', function (Blueprint $table): void {
            $table->id();
            $table->string('image_path');
            $table->string('alt')->nullable();
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('climbing_gallery_images');
    }
};
