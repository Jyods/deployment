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
        Schema::create('healths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->nullable();
            $table->foreignId('user_id')->constrained()->nullable();
            $table->enum('status', ['healthy', 'sick', 'recovered', 'dead']);
            $table->string('type');
            $table->string('description');
            $table->string('reference');
            $table->string('reference_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('healths');
    }
};
