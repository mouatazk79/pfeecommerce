<?php

// database/migrations/2024_03_23_000016_create_order_status_changes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusChangesTable extends Migration
{
    public function up()
    {
        Schema::create('order_status_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_id')->constrained('order_status');
            $table->foreignId('to_id')->constrained('order_status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_status_changes');
    }
}
