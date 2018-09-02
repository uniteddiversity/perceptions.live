<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterShearedContentsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shared_contents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('lat')->default('')->nullable(true);
            $table->string('long')->default('')->nullable(true);
            $table->string('default_location', 500)->default('')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
