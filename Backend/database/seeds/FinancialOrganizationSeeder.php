<?php

use App\FinancialOrganization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancialOrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Dutch Bangla Bank',
                'short_name' => 'DBB',
                'address' => 'N/A',
            ],
            [
                'name' => 'Sonali Bank',
                'short_name' => 'SB',
                'address' => 'N/A',
            ],
            [
                'name' => 'Islami Bank Bangladesh Limited',
                'short_name' => 'IBBL',
                'address' => 'N/A',
            ],
            [
                'name' => 'Grameen Bank',
                'short_name' => 'GB',
                'address' => 'N/A',
            ],
            [
                'name' => 'Janata Bank',
                'short_name' => 'JB',
                'address' => 'N/A',
            ],
        ];

        DB::table('financial_organizations')->insert($data);

    }
}
