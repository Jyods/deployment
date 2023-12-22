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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->biginteger('discord')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('identification');
            $table->date('entry')->default(now());
            $table->date('departure')->nullable();
            $table->string('reason')->nullable();
            $table->integer('restrictionClass')->default(0);
            $table->boolean('isActive')->default(true);
            $table->foreignId('rank_id')->constrained()->nullable();
            $table->json('rank_history')->nullable();
            $table->foreignId('company_id')->constrained()->nullable();
            $table->boolean('permission_register')->default(true);
            $table->boolean('permission_creator')->default(true);
            $table->boolean('permission_recruiter')->default(false);
            $table->boolean('permission_broadcaster')->default(false);
            $table->boolean('permission_odt')->default(false);
            $table->boolean('permission_logisitcs')->default(false);
            $table->boolean('permission_eventlead')->default(false);
            $table->boolean('permission_superadmin')->default(false);
            $table->boolean('permission_allchat')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
