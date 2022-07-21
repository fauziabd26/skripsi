<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->integer('stok')->nullable();
            $table->string('file')->nullable();
            $table->uuid('kategori_id')->nullable();
            $table->uuid('satuan_id')->nullable();
            $table->uuid('kondisi_id');
            
            $table->foreign('kategori_id')->references('id')->on('kategoris')
            ->onUpdate('cascade')->onDelete('cascade');;
            $table->foreign('satuan_id')->references('id')->on('satuans')
            ->onUpdate('cascade')->onDelete('cascade');;
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
        Schema::dropIfExists('barangs');
    }
}
