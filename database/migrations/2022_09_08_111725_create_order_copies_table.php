<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_copies', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('details');
            $table->string('lieudedepart');
            $table->string('nature')->default('moto');
            $table->string('lieudelivraison');
            $table->string('montant');
            $table->string('contactdudestinataire');
            $table->timestamps();
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_copies');
    }
}
