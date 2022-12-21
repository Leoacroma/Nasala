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
        Schema::create('enroll', function (Blueprint $table) {
            $table->id();
            $table->string('title_enroll_kh');
            $table->string('title_enroll_eng');
            $table->text('dsc_en_kh')->nullable();
            $table->text('dsc_en_eng')->nullable();
            $table->timestamps();
            $table->index('id');
            $table->index('title_enroll_kh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enroll');
    }
};
