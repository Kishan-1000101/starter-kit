<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'tier_id' => 1,
            'name' => 'ABC Corp',
            'legal_form' => 'LLC',
            'registration_number' => '123456789',
            'vat_number' => 'VAT123456789',
            'address_id' => 1,
            'fixed_phone' => '123-456-7890',
            'email' => 'contact@abccorp.com'
        ]);

        Company::create([
            'tier_id' => 2,
            'name' => 'XYZ Ltd',
            'legal_form' => 'PLC',
            'registration_number' => '987654321',
            'vat_number' => 'VAT987654321',
            'address_id' => 2,
            'fixed_phone' => '098-765-4321',
            'email' => 'info@xyzltd.com'
        ]);

        // Add more initial data as needed
    }
}
