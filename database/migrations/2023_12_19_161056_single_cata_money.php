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
        Schema::create("single_catagory_money", function(Blueprint $table){
            $table->id("id");
            $table->integer("date")->nullable();
            $table->integer("s0")->nullable();
            $table->integer("s1")->nullable();
            $table->integer("s2")->nullable();
            $table->integer("s3")->nullable();
            $table->integer("s4")->nullable();
            $table->integer("s5")->nullable();
            $table->integer("s6")->nullable();
            $table->integer("s7")->nullable();
            $table->integer("s8")->nullable();
            $table->integer("s9")->nullable();
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
