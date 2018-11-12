<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_ktp');
            $table->string('plat_nomor');
            $table->date('mulai_rental');
            $table->date('selesai_rental');
            $table->timestamps();

            $table->foreign('no_ktp')
            ->references('no_ktp')
            ->on('customers')
            ->onDelete('cascade');

            $table->foreign('plat_nomor')
            ->references('plat_nomor')
            ->on('cars')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
}
