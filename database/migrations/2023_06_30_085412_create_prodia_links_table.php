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
        Schema::create('prodia_links', function (Blueprint $table) {
            $table->id();
            $table->string('jobId');
            $table->longText('prompt');
            $table->string('model');
            $table->integer('steps');
            $table->integer('cfgScale');
            $table->integer('seed');
            $table->boolean('upscale');
            $table->string('sampler');
            $table->string('aspectRatio');
            $table->longText('negativePrompt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodia_links');
    }
};
