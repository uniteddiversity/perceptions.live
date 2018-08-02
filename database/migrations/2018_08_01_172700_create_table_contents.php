<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 20);
            $table->string('access_level_id', 150);
            $table->string('type', 150);
            $table->text('content', 150);
            $table->string('lat')->nullable(true);
            $table->string('long')->nullable(true);
            $table->integer('user_id')->nullable(true);
            $table->integer('is_deleted')->nullable(true);
            $table->string('user_ip')->nullable(true);
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
