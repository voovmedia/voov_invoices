<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCompanyNameAndAddPercentageToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Rename the column
            $table->decimal('percentage', 5, 2)->after('company_name');
            $table->renameColumn('company_name', 'billing_name');

            // Add the new column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Rename the column back to the original name
            $table->renameColumn('billing_name', 'company_name');

            // Drop the new column
            $table->dropColumn('percentage');
        });
    }
}
