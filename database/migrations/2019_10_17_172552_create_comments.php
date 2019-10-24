<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('table');
            $table->integer('fk_id')->unsigned();
            $table->text('comment');
            $table->integer('created_by')->unsigned();
            $table->integer('modified_by')->unsigned();
            $table->integer('parent_id')->default(0)->unsigned()->nullable(true);
            $table->integer('status')->default(1)->nullable(true);//4-deleted,3-pending,1-approved,10-admin deleted
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
