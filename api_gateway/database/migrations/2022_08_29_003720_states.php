<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class States extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->string('uf',2)->primary();

            $table->bigInteger('id');
            
            $table->unsignedBigInteger('country_id');
            $table->string('name', 255);
            
            $table->timestamps();
            $table->dateTime('deleted_at', $precision = 0)->nullable();

            $table->index('name');
            $table->index('uf');

            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
