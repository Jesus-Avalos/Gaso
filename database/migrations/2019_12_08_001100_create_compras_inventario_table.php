<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_inventario', function (Blueprint $table) {
            $table->increments('id');
            $table->double('cantidad',8,2);
            $table->double('subtotal',8,2);

            $table->unsignedInteger('compra_id');
            $table->foreign('compra_id')->references('id')->on('compras');

            $table->unsignedInteger('inventario_id');
            $table->foreign('inventario_id')->references('id')->on('inventario');

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
        Schema::dropIfExists('compras_inventario');
    }
}
