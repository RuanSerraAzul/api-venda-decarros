<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Carros extends Migration
{
   
    public function up()
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->id();
            $table->string('modelo');
            $table->integer('ano');
            $table->string('marca');
            $table->string('status');
            $table->float('valor', $total = 8,  $places = 2);
            $table->string('vendido')->default("nao")->nullable($value =true);
            
        });
    }

   
    public function down()
    {
        //
    }
}
