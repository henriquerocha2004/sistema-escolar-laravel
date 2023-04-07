<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classroom', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('identification');
            $table->integer('number_of_vacancies');
            $table->string('shift');
            $table->string('level');
            $table->string('localization')->nullable();
            $table->integer('vacancies_occupied')->nullable();
            $table->string('status');
            $table->dateTime('open_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classroom');
    }
};
