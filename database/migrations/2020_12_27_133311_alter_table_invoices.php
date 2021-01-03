<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function ($table) {
            $table->String('customer_name');
            $table->String('email');
            $table->String('address_shipping');
            $table->String('city');
            $table->Integer('customer_phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function ($table) {
            $table->dropColumn('customer_name');
            $table->dropColumn('email');
            $table->dropColumn('address_shipping');
            $table->dropColumn('city');
            $table->dropColumn('customer_phone');
        });
    }
}
