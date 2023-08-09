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
        Schema::create('customer_auths', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact');
            $table->string('shipping_address');
            $table->string('email');
            $table->string('password');
            $table->integer('role_id')->default(10);
            $table->string('language')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->boolean('check_me_out')->default(0)->nullable();
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
        Schema::dropIfExists('customer_auths');
    }
};
