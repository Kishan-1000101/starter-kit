<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactType;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactType::create(['name' => 'Email']);
        ContactType::create(['name' => 'Phone']);
        ContactType::create(['name' => 'Address']);
        ContactType::create(['name' => 'Social Media']);
        ContactType::create(['name' => 'Fax']);
        ContactType::create(['name' => 'Website']);
        ContactType::create(['name' => 'Postal']);
        ContactType::create(['name' => 'Instant Messaging']);
        ContactType::create(['name' => 'Video Call']);
        ContactType::create(['name' => 'In-Person']);
    }
}
