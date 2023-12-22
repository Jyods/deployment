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
        Schema::create('official_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->binary('file')->nullable();
            $table->string('file_type')->nullable();
            $table->foreignId('institution_id')->constrained();
            $table->timestamp('usercheckstatus')->nullable();
            $table->timestamp('processstatus')->nullable();
            $table->timestamp('sendupstatus')->nullable();
            $table->timestamp('companystatus')->nullable();
            $table->boolean('waschecked')->default(false);
            $table->boolean('wasredirected')->default(false);
            $table->string('redirectedto')->nullable();
            $table->string('redirectedfrom')->nullable();
            $table->string('redirectedcomment')->nullable();
            $table->timestamp('redirectedstatus')->nullable();
            $table->timestamp('senddownstatus')->nullable();
            $table->boolean('shouldreply')->default(false);
            $table->timestamp('deliverystatus')->nullable();
            $table->boolean('gonemissing')->default(false);
            $table->string('missingcomment')->nullable();
            $table->boolean('isdeleted')->default(false);
            $table->boolean('isarchived')->default(false);
            $table->string('error')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('isanswer')->default(false);
            $table->foreignId('official_document_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });

        //mache aus der spalte file einen longblob
        DB::statement("ALTER TABLE official_documents MODIFY file MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('official_documents');
    }
};
