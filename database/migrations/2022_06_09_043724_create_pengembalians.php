<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalians extends Migration
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
            $table->uuid('peminjaman_id');
            $table->uuid('kondisi_id');
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
