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
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('jenis_kelamin', ['l', 'p'])->default('l');
            $table->string('nama_perusahaan')->nullable();
            $table->string('nama_universitas')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('jurusan')->nullable();
            $table->year('tahun_kerja')->nullable();
            $table->string('alamat')->nullable();
            $table->longText('alasan_mencari_kerja')->nullable();
            $table->string('kontak')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->string('alamat_usaha')->nullable();
            $table->year('tahun_usaha')->nullable();
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
        Schema::dropIfExists('containers');
    }
};
