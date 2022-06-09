<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aprovals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_peminjam');
            $table->string('jumlah_peminjaman');
            $table->date('tanggal_peminjaman');
            $table->uuid('barang_id');
            $table->uuid('kategori_id');
            $table->uuid('satuan_id');
            $table->uuid('user_id');
            $table->foreign('barang_id')->references('id')->on('barangs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('satuan_id')->references('id')->on('satuans')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('aprovals');
    }
}
