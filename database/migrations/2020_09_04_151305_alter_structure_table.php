<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStructureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->string('type', 20)->nullable()->comment('')->change();
        });

        Schema::table('request_comment_attachments', function (Blueprint $table) {
            $table->dropIndex(['request_comment_id']);
            $table->primary(['request_comment_id', 'attachment_id'], 'primary_request_attachment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->integer('type')->comment('1:image|2:doc|3:video')->change();
        });

//        Schema::table('request_comment_attachments', function (Blueprint $table) {
//            $table->dropPrimary(['request_comment_id', 'attachment_id']);
//            $table->index(['request_comment_id'], 'index_request_comment_id');
//        });
    }
}
