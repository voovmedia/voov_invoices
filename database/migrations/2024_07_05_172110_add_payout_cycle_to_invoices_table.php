<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('payout_cycle_start')->nullable()->after('due_date');
            $table->string('payout_cycle_end')->nullable()->after('payout_cycle_start');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('payout_cycle_start');
            $table->dropColumn('payout_cycle_end');
        });
    }
};

