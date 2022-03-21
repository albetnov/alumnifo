<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mencari_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->fulltext();
            $table->string('slug');
            $table->enum('jenis_kelamin', ['l', 'p']);
            $table->string('alamat');
            $table->string('alasan_mencari_kerja');
            $table->string('kontak');
            $table->string('gambar')->nullable();
            $table->string('dibuat');
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
        Schema::dropIfExists('mencari_kerjas');
    }
};
