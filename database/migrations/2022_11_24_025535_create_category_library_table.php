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
        Schema::create('category_library', function (Blueprint $table) {
            $table->id();
            $table->string('title_lib_cate_kh');
            $table->string('title_lib_cate_eng')->nullable();
            $table->timestamps();
            $table->index('id');
            $table->index('title_lib_cate_eng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_library');
    }
};
