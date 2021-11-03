<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->boolean('is_pdf')->nullable();
            $table->boolean('is_audio')->nullable();
            $table->boolean('is_image')->nullable();
            $table->boolean('is_video')->nullable();
            $table->boolean('is_html')->nullable();
            $table->string('file_url')->nullable();
            $table->text('blurb')->nullable();
            $table->longText('content_html')->nullable();
            $table->bigInteger('content_size')->nullable();
            $table->enum('edit_quality', ['high', 'medium', 'low'])->nullable();
            $table
                ->enum('formatting_quality', ['high', 'medium', 'low'])
                ->nullable();
            $table->enum('publication_permission', [
                'author',
                'editor',
                'publisher',
                'translator',
                'recipient',
                'fair use',
                'unknown',
            ]);
            $table->text('notes')->nullable();
            $table->enum('input_type', ['scanned', 'typed', 'transcribed']);
            $table->enum('publication_approval', [
                'approved',
                'rejected',
                'pending',
            ]);
            $table->bigInteger('views');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
