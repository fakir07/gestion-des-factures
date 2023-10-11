<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices__details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_invoice');
            $table->string('invoice_numbre',50);
            $table->foreign('id_invoice')->references('id')->on('invoices')->onDelete('cascade');
            $table->string('poduit',50);
            $table->string('section',50);
            $table->string('Status',50);
            $table->integer('Value_Status');
            $table->text('note');
            $table->string('user',100);
            $table->date('Payment_Date')->nullable();
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
        Schema::dropIfExists('invoices__details');
    }
}
