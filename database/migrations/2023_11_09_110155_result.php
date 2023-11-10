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
        Schema::create("result", function(Blueprint $table){
            $table->id("id");
            $table->string("date")->nullable();
            $table->string("game_id")->nullable();
            $table->string("time_id")->nullable();
            $table->string("catagory_id")->nullable();
            $table->string("box_number")->nullable();
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
