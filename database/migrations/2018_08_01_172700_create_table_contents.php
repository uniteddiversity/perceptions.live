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
            $table->string('title', 5000);
            $table->dateTime('captured_date')->nullable(true);
            $table->dateTime('video_date')->nullable(true);
            $table->text('video_producer')->nullable(true);
            $table->text('onscreen')->nullable(true);
            $table->text('organization')->nullable(true);
            $table->text('learn_more_url')->nullable(true);
            $table->text('co_creators')->nullable(true);
            $table->integer('category_id')->default(0)->nullable(true);
            $table->integer('grater_community_intention_id')->default(0)->nullable(true);
            $table->string('primary_subject_tag')->default('')->nullable(true);
            $table->string('secondary_subject_tag_id')->default('')->nullable(true);
            $table->string('submitted_footage')->default('no')->nullable(true);;//yes,no
            $table->text('brief_description')->nullable(true);
            $table->text('description')->nullable(true);
            $table->string('location')->nullable(true);
            $table->string('lat')->nullable(true);
            $table->string('long')->nullable(true);
            $table->string('url_split')->nullable(true);
            $table->string('full_embed_code')->nullable(true);
            $table->string('url', 650)->nullable(true);
            $table->string('video_id')->nullable(true);
            $table->string('video_id_old')->nullable(true);

            $table->text('user_comment')->nullable(true);//comment add by user at the time submits
            $table->string('access_level_id', 150);
//            $table->string('type', 150);

            $table->integer('user_id')->nullable(true);
            $table->integer('status')->default(2)->nullable(true);//1-published/2-un published/3-deleted
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
