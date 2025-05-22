<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // For SQLite, we need to recreate the table without the columns
        if (DB::connection()->getDriverName() === 'sqlite') {
            // Step 1: Create a new table without the columns we want to drop
            Schema::create('projects_new', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->string('image_cover');
                $table->text('short_description')->nullable();
                $table->text('content')->nullable();
                $table->string('external_link')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
                
                // Add any other columns from the original projects table
                // that you want to keep (except 'name' and 'slug')
            });
            
            // Step 2: Copy data from the old table to the new one
            $columns = ['id', 'category_id', 'image_cover', 'short_description', 'content', 'external_link', 'is_active', 'created_at', 'updated_at'];
            $rows = DB::table('projects')->select($columns)->get();
            
            foreach ($rows as $row) {
                DB::table('projects_new')->insert((array) $row);
            }
            
            // Step 3: Drop the old table
            Schema::dropIfExists('projects');
            
            // Step 4: Rename the new table to the original name
            Schema::rename('projects_new', 'projects');
        } else {
            // For other database systems, we can use the normal approach
            Schema::table('projects', function (Blueprint $table) {
                if (Schema::hasColumn('projects', 'name')) {
                    $table->dropColumn('name');
                }
                
                if (Schema::hasColumn('projects', 'slug')) {
                    $table->dropColumn('slug');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            // Similar approach for reverting changes in SQLite
            Schema::table('projects', function (Blueprint $table) {
                $table->string('name')->nullable();
                $table->string('slug')->nullable();
            });
        } else {
            Schema::table('projects', function (Blueprint $table) {
                $table->string('name')->nullable();
                $table->string('slug')->nullable()->unique();
            });
        }
    }
};