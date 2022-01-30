<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('maker_code')->nullable();
            $table->string('cm_number')->nullable()->index();
            $table->string('maker_name')->nullable();
            $table->string('name')->nullable();
            $table->string('category')->nullable();
            $table->unsignedInteger('wholesale_price')->nullable();
            $table->unsignedInteger('sale_price')->nullable();
            $table->foreignId('maker_id')->constrained('makers')->nullable();
            $table->foreignId('supplier_id')->constrained('makers')->nullable();
            $table->string('country_of_origin')->nullable();
            $table->string('material')->nullable();
            $table->string('head_name')->nullable();
            $table->string('maker_description')->nullable();
            $table->string('description')->nullable();
            $table->string('sex')->nullable();
            $table->unsignedSmallInteger('packing_shape');
            $table->string('pack_size');
            $table->boolean('postage_flag');
            $table->unsignedInteger('limit_stock')->nullable();
            $table->string('remarks')->nullable();
            $table->date('delivery_date')->nullable();
            $table->boolean('sale_flag')->default(0)->comment('出品済みフラグ');
            $table->boolean('stop_sale_flag')->default(0);
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
        Schema::dropIfExists('items');
    }
}
