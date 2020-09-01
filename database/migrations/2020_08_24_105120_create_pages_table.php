<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['blog', 'manual', 'faq']);
            $table->string('title', 255);
            $table->text('content')->nullable();
            $table->text('image')->nullable();
            $table->boolean('release')->default(1)->comment('0: false | 1: true');
            $table->dateTime('release_date')->nullable();
            $table->boolean('public')->default(0)->comment('0: false | 1: true');
            $table->text('public_destination')->nullable();
            $table->text('files')->nullable();
            $table->unsignedInteger('owner_id');
            $table->unsignedInteger('category_id')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
