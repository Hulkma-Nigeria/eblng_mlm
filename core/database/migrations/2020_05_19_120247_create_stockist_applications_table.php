<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockistApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockist_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('passport');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender');
            $table->string('email');
            $table->string('mobile');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('zip')->nullable(true);
            $table->string('address');
            $table->string('store_country');
            $table->string('store_state');
            $table->string('store_city');
            $table->string('store_zip')->nullable(true);
            $table->string('store_address');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stockist_applications');
    }
}
