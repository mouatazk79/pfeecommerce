<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class CreateProductVariationAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('product_variation_attributes', function (Blueprint $table) {
            $table->foreignId('variation_id')->constrained('product_variations');
            $table->foreignId('attribute_id')->constrained('attributes');
            $table->foreignId('option_id')->constrained('options');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variation_attributes');
    }
}
