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
        Schema::create('publishes', function (Blueprint $table) {
            $table->id();
            $table->string('route')->unique();
            $table->integer('fileID');
            $table->foreignId('entry_id')->constrained(); 
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('publisher_id')->constrained('users');
            $table->string('definition')->nullable();
            $table->date('date')->nullable();
            $table->string('description')->nullable();
            $table->string('fine')->nullable();
            $table->boolean('isRestricted')->default(0);
            $table->integer('restrictionClass')->nullable();
            $table->foreignId('rank_id')->constrained()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishes');
    }
};
