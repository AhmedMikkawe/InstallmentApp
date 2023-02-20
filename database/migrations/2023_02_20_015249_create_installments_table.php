<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->enum("installment_status",['pending','approved','rejected'])->default('pending');
            $table->string("receipt_photo");
            $table->double("value");
            $table->date("date");
            $table->timestamps();
            $table->foreignId("installment_requests_id")->references('id')->on("installment_requests")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installments');
    }
};
