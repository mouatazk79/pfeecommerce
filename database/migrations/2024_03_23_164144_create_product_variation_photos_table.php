<?php

// database/migrations/2024_03_23_000006_create_product_variation_photos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationPhotosTable extends Migration
{
    public function up()
    {
        Schema::create('product_variation_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variation_id')->constrained('product_variations');
            $table->string('photo_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variation_photos');
    }
}
