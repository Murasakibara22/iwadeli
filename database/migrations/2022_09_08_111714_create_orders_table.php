<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('details');
            $table->string('lieudedepart');
            $table->string('nature')->default('moto');
            $table->string('lieudelivraison');
            $table->string('montant');
            $table->Boolean('status')->default(0);
            $table->Boolean('terminate')->default(0);
            $table->string('contactdudestinataire');
            $table->timestamps();
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->on('users')->references('id')->onDelete('cascade');

            $table->unsignedBigInteger('id_livreurs');
            $table->foreign('id_livreurs')->on('livreurs')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
