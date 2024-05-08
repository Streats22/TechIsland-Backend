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
        Schema::create('Schools', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('school_dean')->nullable();
            $table->string('adres')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('number_extra')->nullable();
            $table->string('school_phone')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_email')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Schools');
    }
};
