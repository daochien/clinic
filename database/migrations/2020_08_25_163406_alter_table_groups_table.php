<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn(['postal_code', 'address']);
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->boolean('forced')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
