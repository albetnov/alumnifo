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
        Schema::create('request_edits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_container')->nullable()->constrained('containers', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_user')->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('id_table');
            $table->string('table_type');
            $table->enum('status', ['accepted', 'rejected', 'pending'])->default('pending');
            $table->string('handled_by')->nullable();
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
        Schema::dropIfExists('request_edits');
    }
};
