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
            $table->foreignId('item_id')->constrained('items')->nullable()->index();
            $table->string('maker_size');
            $table->string('maker_color');
            $table->string('maker_type1')->nullable();
            $table->string('size')->nullable();
            $table->string('size_display_order')->nullable();
            $table->string('color')->nullable();
            $table->string('color_display_order')->nullable();
            $table->string('item_type1')->nullable();
            $table->string('type3_display_order')->nullable();
            $table->string('sku_code')->index();
            $table->string('barcode')->nullable();
            $table->unsignedSmallInteger('stocks')->nullable();
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
