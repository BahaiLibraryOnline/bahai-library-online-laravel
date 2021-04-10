<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToLocationSearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_search', function (Blueprint $table) {
            $table
                ->foreign('location_id')
                ->references('id')
                ->on('locations');

            $table
                ->foreign('search_id')
                ->references('id')
                ->on('searches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_search', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropForeign(['search_id']);
        });
    }
}
