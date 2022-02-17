<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContentDownloadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_download', function (Blueprint $table) {
            $table->id();
            $table->string('content_id');
            $table->string('content_title');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('response_date');
            $table->string('system_id');
            $table->string('cardno');
            $table->string('c_id');
            $table->string('answer');
            $table->string('cus_id');
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
        //
    }
}
