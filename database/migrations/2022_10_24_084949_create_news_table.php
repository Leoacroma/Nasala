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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->text('title_kh');
            $table->string('image');
            $table->text('title_eng')->nullable();
            $table->unsignedBigInteger('categories_id')->nullable();
            $table->foreign('categories_id')->references('id')->on('news_categories');
            $table->text('dsc_kh')->nullable();
            $table->text('dsc_eng')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->index('id');
            $table->index('title_kh');
            $table->index('title_eng');
            $table->index('categories_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
