<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_logs', function (Blueprint $table) {

                $table->bigIncrements('id');
                $table->smallInteger('level')->index();
                $table->longText('request')->index();
                $table->text('context')->index();
                $table->unsignedInteger('created_by')->nullable()->index();
                $table->dateTime('created_at')->index();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('api_logs');
    }
}
