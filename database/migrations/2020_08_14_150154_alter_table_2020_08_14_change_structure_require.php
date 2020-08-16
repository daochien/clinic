<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTable20200814ChangeStructureRequire extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->text('post_code')->nullable()->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->text('description')->nullable();
        });

        Schema::table('clinic_users', function (Blueprint $table) {
            $table->unique(['clinic_id', 'user_id']);
        });

        Schema::table('group_users', function (Blueprint $table) {
            $table->unique(['group_id', 'user_id']);
        });

        Schema::table('type_users', function (Blueprint $table) {
            $table->unique(['type_id', 'user_id']);
        });

        Schema::table('inquiry_users', function (Blueprint $table) {
            $table->unique(['inquiry_id', 'user_id']);
        });

        Schema::table('level_users', function (Blueprint $table) {
            $table->unique(['level_id', 'user_id']);
        });

        Schema::table('role_user', function (Blueprint $table) {
            $table->unique(['role_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->text('post_code')->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->drop('description');
        });
    }
}
