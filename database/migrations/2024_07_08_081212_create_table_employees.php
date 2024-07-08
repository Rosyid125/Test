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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('address', 100)->nullable();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('dept_id')->nullable();
            $table->enum('status', ['cont', 'emp', 'not_act'])->default('cont');
            $table->timestamps();

            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
