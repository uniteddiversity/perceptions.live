<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->start_from(10000);
            $table->integer('user_id');
            $table->string('invoice_type');
            $table->json('invoice_element');
            $table->decimal('amount',10,2)->default(0);
            $table->string('status')->default(0);
            $table->timestamps();
        });

        //then set autoincrement to 1000
        DB::update("ALTER TABLE invoices AUTO_INCREMENT = 1000;");
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
