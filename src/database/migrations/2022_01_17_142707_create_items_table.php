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
            $table->string('maker_item_name')->nullable();
            $table->string('name')->nullable();
            $table->string('category')->nullable();
            $table->unsignedInteger('wholesale_price')->nullable();
            $table->unsignedInteger('sale_price')->nullable();
            $table->foreignId('maker_id')->nullable()->constrained('makers');
            $table->foreignId('supplier_id')->nullable()->constrained('makers');
            $table->string('country_of_origin')->nullable();
            $table->string('material')->nullable();
            $table->string('head_name')->nullable();
            $table->text('maker_description')->nullable();
            $table->text('description')->nullable();
            $table->string('sex')->nullable();
            $table->unsignedSmallInteger('packing_shape')->nullable();
            $table->string('pack_size')->nullable();
            $table->boolean('postage_flag')->nullable();
            $table->unsignedInteger('limit_stock')->nullable();
            $table->text('remarks')->nullable();
            $table->tinyInteger('delivery_date')->nullable();
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
