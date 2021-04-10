<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToCollectionDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collection_document', function (Blueprint $table) {
            $table
                ->foreign('collection_id')
                ->references('id')
                ->on('collections');

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
        Schema::table('collection_document', function (Blueprint $table) {
            $table->dropForeign(['collection_id']);
            $table->dropForeign(['document_id']);
        });
    }
}
