<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembaliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jumlah_pengembalian');
            $table->date('tanggal_pengembalian');
            $table->enum('approvals', ['ya', 'tidak']);
            $table->uuid('kode_barang');
            $table->uuid('kategori_id');
            $table->uuid('satuan_id');
            $table->uuid('user_id');
            $table->uuid('peminjaman_id');
            $table->uuid('kondisi_id');
            $table->foreign('kode_barang')->references('id')->on('barangs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('satuan_id')->references('id')->on('satuans')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('peminjaman_id')->references('id')->on('peminjamans')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kondisi_id')->references('id')->on('kondisis')
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
        Schema::dropIfExists('pengembalians');
    }
}
