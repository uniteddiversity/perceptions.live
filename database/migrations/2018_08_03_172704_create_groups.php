<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('greeting_message_to_community', 800)->nullable(true);
            $table->string('name', 600);
            $table->text('description')->nullable(true);
            $table->text('current_mission')->nullable(true);
            $table->text('experience_knowledge_interests')->nullable(true);
            $table->string('default_location', 800)->nullable(true);
            $table->integer('category_id')->nullable(true);
            $table->string('learn_more_url', 800)->nullable(true);
            $table->integer('contact_user_id')->nullable(true);
            $table->integer('created_by')->nullable(true);
            $table->string('contact_name', 800)->nullable(true);
            $table->string('contact_email', 800)->nullable(true);
            $table->integer('accept_tos')->default(0)->nullable(true);
            $table->integer('status')->default(1)->nullable(true);//1-active, 2-inactive, 3-deleted, 5-system created
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
