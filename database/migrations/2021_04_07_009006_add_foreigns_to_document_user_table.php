<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToDocumentUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_user', function (Blueprint $table) {
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');

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
        Schema::table('document_user', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['document_id']);
        });
    }
}
