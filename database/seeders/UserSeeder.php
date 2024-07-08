<?php

namespace Database\Seeders;

use PDOException;
use App\Models\User;
use App\Models\Address;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
//use App\Actions\Fortify\PasswordValidationRules;

class UserSeeder extends Seeder
{

    //use PasswordValidationRules;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($makeAdminAccount = true)
    {
        if ($makeAdminAccount) {
            $this->makeAdmin();
        }

        $inputs = [
            'login' => 'abianchi',
            'password' => 'lnroot22',
            'password_confirmation' => 'lnroot22',
            'email' => 'adrien@adyllium.com',
            'firstname' => 'Adrien',
            'lastname' => 'BIANCHI',

            'title' => 1,
            'company' => 'Adyllium',
            'legal_form' => 'AE',
            'registration_number' => '514 104 181 00037',
            'company_position' => 'Dirigeant',
            'fixed_phone' => '0033982123769',
            'mobile_phone' => '0033648453906',
            'address' => 'Ferme de Remenoncourt',
            'address_no' => '3',
            'building' => '',
            'zip_code' => '55230',
            'city' => 'Saint-Pierrevillers',
            'country' => 'FRA',
            'company_email' => 'contact@adyllium.com',
            'company_address' => 'Ferme de Remenoncourt',
            'company_address_no' => '3',
            'company_building' => '',
            'company_zip_code' => '55230',
            'company_city' => 'Saint-Pierrevillers',
            'company_country' => 'FRA',
            'company_fixed_phone' => '0033982123769',

        ];
        $this->makeSuperAdminProfile($inputs);
        /*  DB::table('users')->insert([
            'name' => Str::random(10),
            'login' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('password'),
        ]); */
    }

    private function makeAdmin()
    {
        if (!User::where('login', 'si4webadmin')->exists()) {

            $inputs = [
                'firstname' => "Administrator",
                'lastname' => "LuxNetwork",
                'login' => "si4webadmin",
                'email' => 'si4webadmin@luxnetwork.eu',
                'password' => '/)hqV!&\?8`cQS?4*C',
                'password_confirmation' => '/)hqV!&\?8`cQS?4*C',
            ];
            $this->makeSuperAdminProfile($inputs);
        }
    }

    private function makeSuperAdminProfile($input)
    {
        /* $validator = Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'company' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate(); */

        return DB::transaction(function () use ($input) {
            $company = null;
            if (isset($input['company'])) {
                $companyAddressValues = [
                    'street' => (!empty($input['company_address'])) ? $input['company_address'] : null,
                    'street_no' => (!empty($input['company_address_no'])) ? $input['company_address_no'] : null,
                    'building' => (!empty($input['company_building'])) ? $input['company_building'] : null,
                    'zip_code' => (!empty($input['company_zip_code'])) ? $input['company_zip_code'] : null,
                    'city' => (!empty($input['company_city'])) ? $input['company_city'] : null,
                    'country_alpha3' => (!empty($input['company_country'])) ? $input['company_country'] : null,
                ];
                try {
                    $companyAddress = Address::firstOrCreate($companyAddressValues);
                } catch (QueryException $e) {
                    dd($e);
                } catch (PDOException $e) {
                    dd($e);
                }

                $company = Company::firstOrCreate([
                    'name' => (!empty($input['company'])) ? $input['company'] : null,
                    'legal_form' => (!empty($input['legal_form'])) ? $input['legal_form'] : null,
                    'registration_number' => (!empty($input['registration_number'])) ? $input['registration_number'] : null,
                    'vat_number' => (!empty($input['vat_number'])) ? $input['vat_number'] : null,
                    'address_id' => $companyAddress->id,
                    'fixed_phone' => (!empty($input['company_fixed_phone'])) ? $input['company_fixed_phone'] : null,
                    'email' => (!empty($input['company_email'])) ? $input['company_email'] : null,
                ]);
            }
            if (!empty($input['address']) and !empty($input['zip_code']) and !empty($input['city']) and !empty($input['country'])) {
                try {
                    $address = Address::firstOrCreate([
                        'street' => (!empty($input['address'])) ? $input['address'] : null,
                        'street_no' => (!empty($input['address_no'])) ? $input['address_no'] : null,
                        'building' => (!empty($input['building'])) ? $input['building'] : null,
                        'zip_code' => (!empty($input['zip_code'])) ? $input['zip_code'] : null,
                        'city' => (!empty($input['city'])) ? $input['city'] : null,
                        'country_alpha3' => (!empty($input['country'])) ? $input['country'] : null,
                    ]);
                } catch (QueryException $e) {
                    dd($e);
                } catch (PDOException $e) {
                    dd($e);
                }
            }
            $contact = Contact::create([
                'company_id' => (is_object($company)) ? $company->id : null,
                'company_position' => (!empty($input['company_position'])) ? $input['company_position'] : null,
                'title' => (!empty($input['title'])) ? $input['title'] : null,
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'email' => $input['email'],
                'fixed_phone' => (!empty($input['fixed_phone'])) ? $input['fixed_phone'] : null,
                'mobile_phone' => (!empty($input['mobile_phone'])) ? $input['mobile_phone'] : null,
                'address_id' => (isset($address)) ? $address->id : null
            ]);

            return tap(User::create([
                'login' => $input['login'],
                'password' => Hash::make($input['password']),
                'email' => $input['email'],
                'enabled' => true,
                'userable_type' => 'App\Models\Contact',
                'userable_id' => $contact->id,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'authentication_provider' => 'local',
                'is_super_admin' => true,
                'current_team_id' => 1,
                'comment' => 'Créé par le seeder UserSeeder'
            ]));
        });
    }
}
