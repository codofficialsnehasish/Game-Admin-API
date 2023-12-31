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
        Schema::create("history", function(Blueprint $table){
            $table->id("id");
            $table->string("date")->nullable();
            $table->string("customer_id")->nullable();
            $table->string("game_id")->nullable();
            $table->string("payon")->nullable();
            $table->string("winamount")->nullable();
            $table->timestamps();
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
