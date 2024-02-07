<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tid');
            $table->string('username');
            $table->integer('level')->default(1);
            $table->timestamps();
            $table->string('test')->default('test');
        });
        Schema::create('client_offers', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('offer_id');
            $table->integer('state')->default(0);
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
        Schema::dropIfExists('clients');
        Schema::dropIfExists('client_offers');
    }
}
