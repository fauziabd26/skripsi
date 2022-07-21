<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tggl_masuk')->nullable();
            $table->string('stok')->nullable();
            $table->uuid('barang_id');
            $table->foreign('barang_id')->references('id')->on('barangs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->uuid('suppliers_id');
            $table->foreign('suppliers_id')->references('id')->on('suppliers')
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
        Schema::dropIfExists('barang_masuks');
    }
}
