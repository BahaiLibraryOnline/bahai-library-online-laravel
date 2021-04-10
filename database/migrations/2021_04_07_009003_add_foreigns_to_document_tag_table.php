<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToDocumentTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_tag', function (Blueprint $table) {
            $table
                ->foreign('tag_id')
                ->references('id')
                ->on('tags');

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
        Schema::table('document_tag', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['document_id']);
        });
    }
}
