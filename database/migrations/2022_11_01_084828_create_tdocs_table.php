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
        Schema::create('tdocs', function (Blueprint $table) {
            $table->id();
            $table->text('title_kh');
            $table->text('title_eng')->nullable();
            $table->text('dsc_kh');
            $table->text('dsc_eng');
            $table->timestamps();
            $table->index('id');
            $table->index('title_kh');
            $table->index('title_eng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdocs');
    }
};
