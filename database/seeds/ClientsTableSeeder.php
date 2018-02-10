<?php

use App\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');
        for($i=0; $i<10000; $i++){
            $client = new Client();
            $client->is_company = $faker->boolean;
            $client->name =  $faker->name;
            if($client->is_company){
                $client->name = $faker->company." ".$faker->companySuffix;
            }
            $client->address = $faker->address;
            $client->fax = $faker->phoneNumber;
            $client->phone1 = $faker->phoneNumber;
            $client->phone2 = $faker->phoneNumber;
            $client->nif = $faker->vat;
            $client->save();
        }
    }
}
