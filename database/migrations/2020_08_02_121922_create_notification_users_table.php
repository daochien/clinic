<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_users', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(0)->comment('1:waiting|2:read|3:rejected');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('notification_id');
            $table->timestamps();

            $table->index(['user_id', 'notification_id'], 'idx_user_notification');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_users');
    }
}
