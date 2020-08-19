<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAndAfterTableUsersPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('permissions', 'route_name')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->dropColumn('route_name');           
            });
        }

        if (Schema::hasColumn('users', 'note')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('note')->nullable()->change();           
            });
        }
        
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
    }
}
