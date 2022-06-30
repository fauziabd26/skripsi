<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanPaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_pakets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kode_paket');
            $table->string('nama_peminjam');
            $table->string('jumlah_peminjaman');
            $table->string('tanggal_peminjaman');
            $table->time('waktu_peminjaman');
            $table->foreign('kode_paket')->references('id')->on('pakets')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('peminjaman_pakets');
    }
}
