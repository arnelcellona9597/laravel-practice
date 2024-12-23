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
        Schema::create('student_subject', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
            ->references('id') // Column in the 'users' table
            ->on('subjects') // The related table
            ->onDelete('cascade'); // Optional: Defines the action on delete (e.g., cascade, set null)

            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')
            ->references('id') // Column in the 'users' table
            ->on('students') // The related table
            ->onDelete('cascade'); // Optional: Defines the action on delete (e.g., cascade, set null)

            $table->string('grade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_subject');
    }
};
