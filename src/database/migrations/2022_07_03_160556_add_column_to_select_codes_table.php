<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToSelectCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('select_codes', function (Blueprint $table) {
            $table->string('sku_code')->after('original_code')->nullable()->comment('SKU上の対応するコード');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('select_codes', function (Blueprint $table) {
            $table->dropColumn('sku_code');
        });
    }
}
