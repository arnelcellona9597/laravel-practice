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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
            ->references('id') // Column in the 'users' table
            ->on('users') // The related table
            ->onDelete('cascade'); // Optional: Defines the action on delete (e.g., cascade, set null)

            $table->string('name');
            $table->string('address');
            $table->string('year_level');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
