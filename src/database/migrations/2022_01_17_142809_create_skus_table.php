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
            $table->string('maker_type1');
            $table->string('maker_type2');
            $table->string('maker_type3');
            $table->string('item_type1');
            $table->string('type1_display_order');
            $table->string('item_type2');
            $table->string('type2_display_order');
            $table->string('item_type3');
            $table->string('type3_display_order');
            $table->string('sku_code')->index();
            $table->string('barcode');
            $table->unsignedSmallInteger('stocks');
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
