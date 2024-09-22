<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_cards', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id'); // Foreign key for the user
            $table->text('medical_history')->nullable(); // Optional field for medical history
            $table->string('allergies')->nullable(); // Optional field for allergies
            $table->string('name'); // Contact name
            $table->string('relation'); // Relationship to the contact
            $table->string('contact_no', 11); // Contact number (11 characters max)
            $table->timestamps(); // Timestamps for created_at and updated_at 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_cards');
    }
}