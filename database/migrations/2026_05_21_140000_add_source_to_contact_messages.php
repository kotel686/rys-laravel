<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add a `source` column to contact_messages so the admin can tell
     * which form on which mini-site produced the message.
     */
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table): void {
            $table->string('source', 60)
                ->default('vyskoveprace')
                ->index()
                ->after('message');
        });
    }

    /**
     * Drop the `source` column.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table): void {
            $table->dropColumn('source');
        });
    }
};
