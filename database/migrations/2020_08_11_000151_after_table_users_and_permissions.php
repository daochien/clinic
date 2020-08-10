<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AfterTableUsersAndPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('note');           
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->string('route_name');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('note');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('route_name');           
        });
    }
}
