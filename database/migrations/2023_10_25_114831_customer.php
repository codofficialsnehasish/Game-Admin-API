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
        Schema::create("customer", function(Blueprint $table){
            $table->id("id");
            $table->string("reg_date");
            $table->string("beneficiary_name");	
            $table->string("mobile")->nullable();
            $table->string("wallet_balance")->nullable();
            $table->string("google_pay_no")->nullable();
            $table->string("paytm_no")->nullable();
            $table->string("email")->nullable();
            $table->string("password");
            $table->string("m_pin");
            $table->string("adding_mode")->nullable();
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
