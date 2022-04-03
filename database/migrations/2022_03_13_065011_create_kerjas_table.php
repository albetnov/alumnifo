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
        Schema::create('kerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_request')->nullable()->constrained('requests', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name')->fulltext();
            $table->string('slug');
            $table->enum('jenis_kelamin', ['l', 'p']);
            $table->string('nama_perusahaan')->fulltext();
            $table->string('jabatan')->fulltext();
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
        Schema::dropIfExists('kerjas');
    }
};
