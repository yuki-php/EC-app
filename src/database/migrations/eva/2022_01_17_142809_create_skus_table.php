<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->nullable();
            $table->string('maker_color');
            $table->string('color');
            $table->string('color_display_order');
            $table->string('maker_size');
            $table->string('size');
            $table->string('size_display_order');
            $table->string('sku_coode');
            $table->unsignedSmallInteger('stocks');
            $table->foreignId('color_image_id')->constrained('images')->nullable();
            $table->foreignId('size_image_id')->constrained('images')->nullable();
            $table->boolean('out_of_stock_flag')->default(0)->comment('在庫切れフラグ');
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
        Schema::dropIfExists('skus');
    }
}
