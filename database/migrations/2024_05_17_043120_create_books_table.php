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
            $table->bigInteger('category_id')->unsigned()->index();
            $table->string('name', 200); // 書籍名、最大200文字
            $table->text('description', 1000)->nullable(); //書籍説明、最大1000文字
            $table->string('author'); // 著者
            $table->string('publisher'); // 出版社
            $table->string('image')->nullable();
            $table->timestamps(); // created_atとupdated_atカラムを自動作成

            // 外部キー制約
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
