<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerja_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->fulltext();
            $table->string('slug');
            $table->enum('jenis_kelamin', ['l', 'p']);
            $table->string('nama_perusahaan')->fulltext();
            $table->string('nama_universitas')->fulltext();
            $table->string('jabatan')->fulltext();
            $table->string('jurusan')->fulltext();
            $table->year('tahun_kerja');
            $table->string('dibuat');
            $table->string('gambar')->nullable();
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
        Schema::dropIfExists('kerja_kuliahs');
    }
};
