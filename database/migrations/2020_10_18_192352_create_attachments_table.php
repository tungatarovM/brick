<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_id');
            $table->foreignId('comment_id');
            $table->enum('type', ['image', 'video', 'file', 'document'])->default('image');
            $table->text('url');
            $table->timestamps();

            $table->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->cascadeOnDelete();

            $table->foreign('creator_id')
                ->references('id')
                ->on('users');

            $table->index('comment_id');
            $table->index('creator_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
