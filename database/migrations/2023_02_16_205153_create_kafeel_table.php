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
        Schema::create('kafeel', function (Blueprint $table) {
            $table->id();
            $table->string("fullname");
            $table->string("national_id")->nullable();
            $table->string("phone_number")->nullable();
            $table->string("national_id_photo")->nullable();
            $table->foreignId("user_id")->references("id")->on("users")->onDelete('cascade');
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
        Schema::dropIfExists('kafeel');
    }
};
