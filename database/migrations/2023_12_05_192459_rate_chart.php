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
        Schema::create("rate_chart", function(Blueprint $table){
            $table->id("id");
            $table->string("chart_name_id")->nullable();
            $table->string("type")->nullable();
            $table->string("play")->nullable();
            $table->string("winning")->nullable();
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
