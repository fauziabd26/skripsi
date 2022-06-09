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
            $table->string('name');
            $table->string('jumlah_peminjaman');
            $table->string('tanggal_peminjaman');
            $table->uuid('barang_id');
            $table->uuid('kategori_id');
            $table->uuid('satuan_id');
            $table->uuid('user_id');
            $table->uuid('paket_id');
            $table->foreign('barang_id')->references('id')->on('barangs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('satuan_id')->references('id')->on('satuans')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('paket_id')->references('id')->on('pakets')
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
