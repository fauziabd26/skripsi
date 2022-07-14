<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('kode_barang_peminjaman');
            $table->uuid('id_dosen');
            $table->uuid('nama_peminjam');
            $table->date('tanggal_peminjaman');
            $table->time('waktu_peminjaman');
            $table->enum('aprovals', ['Ya', 'Tidak']);
            $table->enum('status', ['Dipinjam', 'Dikembalikan']);
            $table->foreign('id_dosen')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nama_peminjam')->references('id')->on('users')
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
        Schema::dropIfExists('peminjamans');
    }
}
