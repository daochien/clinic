<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetDefaultPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['downloads', 'views']);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->integer('downloads')->nullable()->default(0);
            $table->integer('views')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
