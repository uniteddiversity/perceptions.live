<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClaimProfileRequestTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claim_profile_request', function (Blueprint $table) {
            $table->engine = 'InnoDB';
//            $table->text('comments')->nullable(true)->change();
//            $table->integer('fk_id')->nullable(true)->change();
            DB::statement('ALTER TABLE `claim_profile_request` CHANGE `comments` `comments` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL');
            DB::statement('ALTER TABLE `claim_profile_request` MODIFY `fk_id` INTEGER UNSIGNED NULL;');
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
