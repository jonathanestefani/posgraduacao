<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('name', 255);
            $table->enum('type', ['F','J']);
            $table->string('cnpj_cpf', 20)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('neighborhood', 255)->nullable();
            $table->string('zip_code', 15)->nullable();
            $table->string('number', 20)->nullable();
            $table->string('complement', 255)->nullable();
            $table->string('phone', 45)->nullable();
            $table->text('email')->nullable();
            $table->integer('status')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
