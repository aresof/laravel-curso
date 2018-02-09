<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('nif');
            $table->string('address');
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();;
            $table->string('mobile')->nullable();;
            $table->string('fax')->nullable();;
            $table->boolean('is_company');
            $table->integer('iva')->default(21);
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
    }
}
