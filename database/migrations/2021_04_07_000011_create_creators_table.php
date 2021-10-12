<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_names')->nullable();
            $table->string('last_names')->nullable();
            $table->boolean('is_author')->nullable();
            $table->boolean('is_editor')->nullable();
            $table->boolean('is_translator')->nullable();
            $table->boolean('is_compiler')->nullable();

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
        Schema::dropIfExists('creators');
    }
}
