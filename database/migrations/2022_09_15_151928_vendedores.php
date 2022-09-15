<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vendedores extends Migration
{

    public function up()
    {
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->string('password');
            $table->integer('carros_vendidos')->default(0)->nullable($value = true);
            $table->float('saldo_vendido', $total = 8,  $places = 2)->default(0)->nullable($value = true);
            
        });
    }


    public function down()
    {
        //
    }
}
