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
            $table->string('key')->unique();
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->string('title');
            $table->string('slug');
            $table->string('course');
            $table->string('pages')->nullable();
            $table->string('pdf');
            $table->string('pdf_size');
            $table->string('month')->nullable();
            $table->string('day')->nullable();
            $table->string('year');
            $table->string('volume')->nullable();
            $table->string('series')->nullable();
            $table->string('publisher')->nullable();
            $table->string('isbn')->nullable();
            $table->string('lc')->nullable();
            $table->string('authornumber')->nullable();
            $table->text('qr')->nullable();
            $table->text('abstract');
            $table->string('type');
            $table->integer('views')->default('0');
            $table->integer('downloads')->default('0');
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
