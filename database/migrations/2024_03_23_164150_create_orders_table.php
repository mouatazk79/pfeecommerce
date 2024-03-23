<?php

// database/migrations/2024_03_23_000013_create_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->decimal('total', 10, 2);
            $table->string('city');
            $table->string('address');
            $table->string('phone');
            $table->foreignId('status_id')->constrained('order_status');
            $table->foreignId('store_id')->constrained();
            $table->dateTime('date_created');
            $table->dateTime('date_updated')->nullable();
            $table->dateTime('date_deleted')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
