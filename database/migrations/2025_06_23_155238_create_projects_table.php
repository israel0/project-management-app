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
        Schema::create('projects', function (Blueprint $table) {
        $table->uuid('id')->primary(); // UUID as primary key
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // still uses auto-increment from users
        $table->string('title');
        $table->text('description')->nullable();
        $table->date('deadline')->nullable();
        $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
