<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesDatakriteriaDatasiswas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datakriteria_datasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_siswa_id');
            $table->unsignedBigInteger('data_kriteria_id');
            $table->double('value')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datakriteria_datasiswas');
    }
}
