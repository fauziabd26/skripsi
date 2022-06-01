<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('barang_id');
            $table->uuid('barangmasuk_id');
            $table->uuid('kategori_id');
            $table->uuid('satuan_id');
            $table->uuid('user_id')->nullable();
            
            $table->foreign('barang_id')->references('id')->on('barangs');
            $table->foreign('barangmasuk_id')->references('id')->on('barang_masuks');
            $table->foreign('kategori_id')->references('id')->on('kategoris');
            $table->foreign('satuan_id')->references('id')->on('satuans');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('laporans');
    }
}
