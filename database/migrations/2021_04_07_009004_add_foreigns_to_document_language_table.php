<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToDocumentLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_language', function (Blueprint $table) {
            $table
                ->foreign('document_id')
                ->references('id')
                ->on('documents');

            $table
                ->foreign('language_id')
                ->references('id')
                ->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_language', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
            $table->dropForeign(['language_id']);
        });
    }
}
