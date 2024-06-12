<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void

    {
        Schema::create('medicine', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->integer('quantity');;
            $table->string('image')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('type');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('company');
            $table->string('expiration_date');


            $table->timestamps();
        });
    }
    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine');
    }
};
