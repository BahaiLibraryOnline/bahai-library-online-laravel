<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table
                ->foreign('input_by')
                ->references('id')
                ->on('users');

            $table
                ->foreign('proof_by')
                ->references('id')
                ->on('users');

            $table
                ->foreign('format_by')
                ->references('id')
                ->on('users');

            $table
                ->foreign('post_by')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['input_by']);
            $table->dropForeign(['proof_by']);
            $table->dropForeign(['format_by']);
            $table->dropForeign(['post_by']);
        });
    }
}
