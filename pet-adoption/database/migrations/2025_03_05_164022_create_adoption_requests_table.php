<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('adoption_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade'); // Pet being requested
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User (adopter) submitting the request
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending'); // Pet owner's decision
            $table->text('rejection_reason')->nullable(); // Reason for rejection by owner
            $table->string('adopter_name')->nullable(); // Name of the adopter
            $table->string('adopter_contact')->nullable(); // Contact of the adopter
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adoption_requests');
    }

};
