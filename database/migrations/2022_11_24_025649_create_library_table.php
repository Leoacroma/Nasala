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
        Schema::create('library', function (Blueprint $table) {
            $table->id();
            $table->string('title_kh');
            $table->string('title_eng')->nullable();
            $table->unsignedBigInteger('cate_id');
            $table->foreign('cate_id')->references('id')->on('category_library');
            $table->string('file');
            $table->timestamps();

            $table->index('id');
            $table->index('title_eng');
            $table->index('cate_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('library');
    }
};
