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
        Schema::create('installment_requests', function (Blueprint $table) {
            $table->id();
            $table->string("required_device");
            $table->enum("request_status",['pending','approved','rejected'])->default('pending');
            $table->enum("request_type",['monthly','3 months' ,'6 months','yearly'])->default('monthly');
            $table->double("installment_value")->nullable();
            $table->integer('installment_count')->nullable();
            $table->double("total")->nullable();
            $table->timestamps();
            $table->foreignId("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('installment_requests');
    }
};
