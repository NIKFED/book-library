<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->string('isbn')->unique();
            $table->integer('page_count');
            $table->string('thumbnail_url')->nullable();

            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();

            $table->dateTime('published_date')->nullable();

            $table->unsignedBigInteger('book_status_id');

            $table->foreign('book_status_id')
                ->references('id')
                ->on('statuses')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
