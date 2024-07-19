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
        //
        Schema::create("order_lines", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("medicine_id");
            $table->integer('quantity');
            $table->foreign("medicine_id")->references("id")->on("medicine");
            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")->references("id")->on("orders");
            $table->bigInteger("price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("orderLine");
    }
};
