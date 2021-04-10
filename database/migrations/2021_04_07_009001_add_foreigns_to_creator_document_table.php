<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToCreatorDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creator_document', function (Blueprint $table) {
            $table
                ->foreign('creator_id')
                ->references('id')
                ->on('creators');

            $table
                ->foreign('document_id')
                ->references('id')
                ->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creator_document', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);
            $table->dropForeign(['document_id']);
        });
    }
}
