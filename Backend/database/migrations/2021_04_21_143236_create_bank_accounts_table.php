<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('financial_organization_id')->comment('Bank table Primary key');
            $table->bigInteger('store_id')->nullable();
            $table->string('account_name', 255);
            $table->string('account_no', 100)->nullable();
            $table->string('branch', 50)->nullable();
            $table->tinyInteger('account_type')->comment('1 = Savings Account, 2 = Current Account, 3 = Joint Account');
            $table->string('swift_code', 100)->nullable();
            $table->string('route_no', 100)->nullable();
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
        Schema::dropIfExists('bank_accounts');
    }
}
