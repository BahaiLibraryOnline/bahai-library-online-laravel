<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('title_parent')->nullable();
            $table->string('volume')->nullable();
            $table->char('page_range')->nullable();
            $table->char('page_total')->nullable();
            $table->string('publisher_name')->nullable();
            $table->string('publisher_city')->nullable();
            $table->date('date')->nullable();
            $table->string('isbn')->nullable();
            $table->unsignedBigInteger('document_id');

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
        Schema::dropIfExists('editions');
    }
}
