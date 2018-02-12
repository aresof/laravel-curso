<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        for($i = 0; $i<10; $i++) {
            $product = new Product();
            $product->name = $faker->word;
            $product->price = $faker->randomFloat(2,1,30);
            $product->save();
        }
    }
}
