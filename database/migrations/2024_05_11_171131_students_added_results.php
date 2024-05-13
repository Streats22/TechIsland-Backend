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
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id')->nullable();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->unsignedBigInteger('result_1')->nullable();
            $table->foreign('result_1')->references('id')->on('workshops')->onDelete('cascade');
            $table->unsignedBigInteger('result_2')->nullable();
            $table->foreign('result_2')->references('id')->on('workshops')->onDelete('cascade');
            $table->unsignedBigInteger('result_3')->nullable();
            $table->foreign('result_3')->references('id')->on('workshops')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
