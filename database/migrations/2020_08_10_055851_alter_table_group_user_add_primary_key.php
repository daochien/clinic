<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableGroupUserAddPrimaryKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_users', function (Blueprint $table) {
            $table->primary(['group_id', 'user_id'], 'pri_key_group_user');
            $table->dropIndex(['group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_users', function (Blueprint $table) {
            $table->dropPrimary(['group_id', 'user_id']);
            $table->index('group_id');
        });
    }
}
