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
        Schema::create('author_books', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('author_id');


            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('restrict');
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
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
        Schema::dropIfExists('author_books');
    }
};
