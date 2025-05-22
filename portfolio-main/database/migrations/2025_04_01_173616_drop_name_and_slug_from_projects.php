<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Check if columns exist before dropping them
            if (Schema::hasColumn('projects', 'name')) {
                $table->dropColumn('name');
            }
            
            if (Schema::hasColumn('projects', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};
