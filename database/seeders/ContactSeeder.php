<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'tier_id' => 1,
            'company_id' => 1,
            'company_position' => 'Manager',
            'contact_type_id' => 1,
            'title' => 'Mr.',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john.doe@example.com',
            'fixed_phone' => '123-456-7890',
            'mobile_phone' => '987-654-3210',
            'address_id' => 1,
        ]);

        Contact::create([
            'tier_id' => 2,
            'company_id' => 2,
            'company_position' => 'CEO',
            'contact_type_id' => 2,
            'title' => 'Ms.',
            'firstname' => 'Jane',
            'lastname' => 'Smith',
            'email' => 'jane.smith@example.com',
            'fixed_phone' => '234-567-8901',
            'mobile_phone' => '876-543-2109',
            'address_id' => 2,
        ]);

        // Add more initial data as needed
    }
}
