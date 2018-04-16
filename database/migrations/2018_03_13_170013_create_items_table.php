<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('remessa_id')->unsigned();
            $table->foreign('remessa_id')->references('id')->on('remessas');
            $table->string('codigo_rastreio')->nullable();
            $table->boolean('AR')->default('false');
            $table->boolean('MP')->default('false');
            $table->boolean('SEDEX')->default('false');
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
        Schema::dropIfExists('items');
    }
}
