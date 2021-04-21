<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $guarded;

    public function financialOrg()
    {
        return $this->belongsTo(FinancialOrganization::class);
    }
}
