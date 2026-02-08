<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tricks', function (Blueprint $table) {
            $table->renameColumn('url', 'youtube');
            $table->string('youtube')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tricks', function (Blueprint $table) {
            $table->string('youtube')->nullable(false)->change();
            $table->renameColumn('youtube', 'url');
        });
    }
};
