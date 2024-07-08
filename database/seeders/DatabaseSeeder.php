<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\{
    CountrySeeder, AddressSeeder, TechnologySeeder, ItemSeeder, StatusSeeder,
    UserSeeder, TierTypeSeeder, ContactSeeder, ContactTypeSeeder, ShareholderMetaSeeder, ShareholderSeeder, TierSeeder, CompanySeeder,
    CategorySeeder, CategorySegmentationSeeder, PricebookSeeder, PricebookTierSeeder, PriceMetaSeeder, PriceSeeder, ProductItemSeeder, ProductReferenceSeeder, ProductSeeder, ReferencePricebookSeeder, ReferenceSeeder, SegmentationSeeder,
};
use Illuminate\Support\Facades\Schema;
use Modules\ProductManager\Database\Seeders\ProductManagerDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            //Seeders for Settings
            CountrySeeder::class,
            AddressSeeder::class,
            ItemSeeder::class,
            StatusSeeder::class,
            TechnologySeeder::class,

            //Seeders for Core
			TierTypeSeeder::class,
            ContactTypeSeeder::class,
            ShareholderMetaSeeder::class,
            TierSeeder::class,
            UserSeeder::class,
            CompanySeeder::class,
            ContactSeeder::class,
            ShareholderSeeder::class,
            
            //Seeders for Product Manager
            SegmentationSeeder::class,
            PriceMetaSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductItemSeeder::class,
            ReferenceSeeder::class,
            ProductReferenceSeeder::class,
            PricebookSeeder::class,
            PricebookTierSeeder::class,
            PriceSeeder::class,
            ReferencePricebookSeeder::class,
            CategorySegmentationSeeder::class,
            
            //Seeders for Task Manager

            //Seeders for Roadmap

            //Seeders for Bollings

            //Seeders for Inventory

            //Seeders for Service Manager

            //Seeders for Operator Manager



            TeamSeeder::class,
        ]);

		Schema::enableForeignKeyConstraints();
    }
}
