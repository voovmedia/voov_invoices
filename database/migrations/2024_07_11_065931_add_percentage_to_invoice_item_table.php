<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPercentageToInvoiceItemTable extends Migration
{
    public function up()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->decimal('percentage', 5, 2)->default(0)->after('price');
        });
    }

    public function down()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropColumn('percentage');
        });
    }
}
