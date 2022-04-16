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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('course');
            $table->date('date_published')->nullable();
            $table->string('pages');
            $table->string('pdf');
            $table->string('volume')->nullable();
            $table->string('series')->nullable();
            $table->string('publisher')->nullable();
            $table->string('year')->nullable();
            $table->text('qr')->nullable();
            $table->text('abstract');
            $table->string('type');
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
        Schema::dropIfExists('posts');
    }
};
