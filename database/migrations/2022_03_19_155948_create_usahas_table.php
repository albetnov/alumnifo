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
        Schema::create('usahas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_request')->nullable()->constrained('requests', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name')->fulltext();
            $table->string('slug');
            $table->enum('jenis_kelamin', ['l', 'p']);
            $table->string('jenis_usaha')->fulltext();
            $table->string('alamat_usaha');
            $table->year('tahun_usaha');
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
        Schema::dropIfExists('usahas');
    }
};
