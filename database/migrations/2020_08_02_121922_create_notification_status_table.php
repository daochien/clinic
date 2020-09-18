<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_status', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('notification_user_id')->index();
            $table->tinyInteger('status')->default(0)->comment('1:read|2:unconfirm|3:confirm');
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
        Schema::dropIfExists('notification_status');
    }
}
