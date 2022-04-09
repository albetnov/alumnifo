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
        Schema::create('public_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->fulltext();
            $table->string('email')->fulltext();
            $table->text('subject')->fulltext();
            $table->longText('message')->fulltext();
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
        Schema::dropIfExists('public_contacts');
    }
};
