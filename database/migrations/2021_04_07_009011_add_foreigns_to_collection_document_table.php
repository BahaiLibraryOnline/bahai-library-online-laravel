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
                ->foreign('document_id')
                ->references('id')
                ->on('documents');

            $table
                ->foreign('collection_id')
                ->references('id')
                ->on('collections');
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
            $table->dropForeign(['document_id']);
            $table->dropForeign(['collection_id']);
        });
    }
}
