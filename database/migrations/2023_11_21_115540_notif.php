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
        Schema::create("notification", function(Blueprint $table){
            $table->id("id");
            $table->string("date")->nullable();
            $table->string("customer_id")->nullable();
            $table->string("amount")->nullable();
            $table->string("which_for")->nullable();
            $table->string("seen")->nullable();
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
