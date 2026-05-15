<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Unify the `photos` and `videos` tables into a single polymorphic
     * `media` table with a `type` discriminator. Existing rows from both
     * legacy tables are copied over, then the old tables are dropped.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table): void {
            $table->id();
            $table->string('type', 16)->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('poster_path')->nullable();
            $table->string('duration', 16)->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });

        if (Schema::hasTable('photos')) {
            foreach (DB::table('photos')->orderBy('id')->get() as $photo) {
                DB::table('media')->insert([
                    'type' => 'image',
                    'title' => $photo->title,
                    'description' => $photo->description,
                    'file_path' => $photo->image_path,
                    'poster_path' => null,
                    'duration' => null,
                    'sort_order' => $photo->sort_order,
                    'is_published' => $photo->is_published,
                    'created_at' => $photo->created_at,
                    'updated_at' => $photo->updated_at,
                ]);
            }

            Schema::drop('photos');
        }

        if (Schema::hasTable('videos')) {
            foreach (DB::table('videos')->orderBy('id')->get() as $video) {
                DB::table('media')->insert([
                    'type' => 'video',
                    'title' => $video->title,
                    'description' => $video->description,
                    'file_path' => $video->video_path,
                    'poster_path' => $video->poster_path,
                    'duration' => $video->duration,
                    'sort_order' => $video->sort_order,
                    'is_published' => $video->is_published,
                    'created_at' => $video->created_at,
                    'updated_at' => $video->updated_at,
                ]);
            }

            Schema::drop('videos');
        }
    }

    /**
     * Recreate the original `photos` / `videos` tables and replay rows back.
     */
    public function down(): void
    {
        Schema::create('photos', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_path');
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('video_path');
            $table->string('poster_path')->nullable();
            $table->string('duration', 16)->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();
        });

        if (Schema::hasTable('media')) {
            foreach (DB::table('media')->orderBy('id')->get() as $row) {
                if ($row->type === 'image') {
                    DB::table('photos')->insert([
                        'title' => $row->title,
                        'description' => $row->description,
                        'image_path' => $row->file_path,
                        'sort_order' => $row->sort_order,
                        'is_published' => $row->is_published,
                        'created_at' => $row->created_at,
                        'updated_at' => $row->updated_at,
                    ]);
                } else {
                    DB::table('videos')->insert([
                        'title' => $row->title,
                        'description' => $row->description,
                        'video_path' => $row->file_path,
                        'poster_path' => $row->poster_path,
                        'duration' => $row->duration,
                        'sort_order' => $row->sort_order,
                        'is_published' => $row->is_published,
                        'created_at' => $row->created_at,
                        'updated_at' => $row->updated_at,
                    ]);
                }
            }

            Schema::drop('media');
        }
    }
};
