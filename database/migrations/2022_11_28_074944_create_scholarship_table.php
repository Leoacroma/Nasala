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
        Schema::create('scholarship', function (Blueprint $table) {
            $table->id();
            $table->string('title_kh');
            $table->string('title_eng')->nullable();
            $table->string('file');
            $table->text('dsc_kh')->nullable();
            $table->text('dsc_eng')->nullable();
            $table->timestamps();

            $table->index('id');
            $table->index('title_kh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scholarship');
    }
};
