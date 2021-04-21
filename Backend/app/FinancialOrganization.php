<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialOrganization extends Model
{
    protected $guarded;

    public function bank_account()
    {
        return $this->hasOne(BankAccount::class);
    }
}
