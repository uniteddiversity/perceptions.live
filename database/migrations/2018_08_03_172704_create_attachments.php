<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('fk_id');
            $table->string('submission_type');//avatar (avatar), Proof of Group Involvement (proof-of-group-in), Group Avatar(group-avatar)
            $table->string('table');
            $table->string('name');
            $table->string('url');
            $table->string('extension', 300);//avi,jpg,doc
            $table->integer('status')->default(1)->nullable(true);//1-published/2-unpublished/3-deleted
            $table->integer('created_by')->default(1)->nullable(true);
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
