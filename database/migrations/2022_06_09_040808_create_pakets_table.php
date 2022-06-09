<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->date('keterangan')->nullable();
            $table->uuid('kode_barang');
            $table->uuid('kategori_id');
            $table->uuid('satuan_id');
            $table->uuid('user_id');
            $table->foreign('kode_barang')->references('id')->on('barangs')
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
        Schema::dropIfExists('pakets');
    }
}
