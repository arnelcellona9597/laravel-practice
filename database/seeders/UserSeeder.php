<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 
class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {

        for ($loop = 0; $loop <= 100; $loop++ ) {

            DB::table('products')->insert([
                'product_id' => Str::random(8),
                'sku' => Str::random(8),
                'name' => Str::random(15),
                'quantity' => rand(1, 100), // Generate a random integer between 1 and 100
                'price' => rand(10, 1000),  // Generate a random price between 10 and 1000
            ]);
        }

    }
}