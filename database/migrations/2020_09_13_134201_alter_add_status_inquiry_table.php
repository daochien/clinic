<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddStatusInquiryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('inquiry_users', 'inquiry_logs');
        Schema::table('inquiry', function (Blueprint $table) {
            $table->smallInteger('status')->after('question')->comment('1: open|2:close');
            $table->string('title', 200)->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('inquiry_logs', 'inquiry_users');
        Schema::table('inquiry', function (Blueprint $table) {
            $table->dropColumn(['status', 'title']);
        });
    }
}
