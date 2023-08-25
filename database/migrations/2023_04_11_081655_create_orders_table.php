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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('db_customers')->onDelete('cascade');
            $table->foreignId('billing_id')->constrained('billings')->onDelete('cascade');
            $table->decimal('sub_total', 10, 2);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->string('cupon_code')->nullable();
            $table->decimal('shipping_charge', 10, 2)->nullable();
            $table->decimal('total', 10, 2);
            $table->string('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
