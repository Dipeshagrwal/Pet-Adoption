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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('dob');
            $table->foreignId('pet_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('pet_breed_id')->constrained()->onDelete('cascade');
            $table->string('gender');
            $table->enum('vaccinated', ['Vaccinated', 'Not Vaccinated']);
            $table->text('pet_characteristics');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('owner_name'); 
            $table->string('whatsapp_no');
            $table->text('description');
            $table->string('state'); // Added: State
            $table->string('city'); // Added: City
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->enum('pet_status', ['Available', 'Adopted'])->default('Available');
            $table->enum('edited_status', ['Not Edited', 'Pending', 'Approved', 'Rejected'])->default('Not Edited');
            $table->text('rejected_reason')->nullable();
            $table->timestamp('adopted_at')->nullable();
            $table->string('image')->nullable(); // Single image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};