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
        Schema::create("on_game", function(Blueprint $table){
            $table->id("id");
            $table->string("date")->nullable();
            $table->string("customer_id")->nullable();
            $table->string("game_id")->nullable();
            $table->string("time_id")->nullable();
            $table->string("catagory_id")->nullable();
            $table->string("box_number")->nullable();
            $table->string("amount")->nullable();
            $table->integer("is_completed");
            $table->integer("is_winner");
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
