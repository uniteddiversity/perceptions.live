<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSortingTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorting_tags', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tag', 800);
            $table->string('tag_color', 20)->nullable(true);
            $table->string('description', 800)->nullable(true);
            $table->integer('created_by')->nullable(true);
            $table->integer('group_id')->nullable(true);
            $table->integer('not_selectable')->default(0)->nullable(true);
            $table->integer('status')->default(1)->nullable(true);
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
