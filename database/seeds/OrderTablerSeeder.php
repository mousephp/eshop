<?php

use Illuminate\Database\Seeder;

use function GuzzleHttp\json_decode;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Faker\Provider\Internet;
use Illuminate\Support\Str;
use Faker\Provider\en_NZ\Phone;
use Faker\Provider\ms_MY\Address;

class OrderTablerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i =0; $i<50;$i++){
            DB::table('orders')->insert(
                [
                    'title'        => $faker->catchPhrase,
                    'photo'        => "/images/" . strval($faker->numberBetween(1,10)) .".jpg",
                    'photo_name'   => $faker->name,
                    'summary'      => $faker->text,
                    'quote'        => $faker->text,
                    'description'  => $faker->text,
                    'status'       => 'active',
                    'slug'         => $faker->slug,

                    'phoaddressne'    => $faker->townState,
                    'phone'    => $faker->mobileNumber,
                    'payment_method'    => 'cod',
                    'payment_status'    => 'new',
                    'full_name'    => $faker->name,
                    'email'       => $faker->unique()->safeEmail,

                    'post_code' => $faker->numberBetween(10000,100000),
                    'order_number' => $faker->numberBetween(10000,100000),
                    'client_id'      => $faker->numberBetween(1,3),

                    'order_status'      => 'new',
                    'quantity'      => $faker->numberBetween(1,100),
                    'coupon'      => $faker->numberBetween(1100, 10000),
                    'total_amount'      => $faker->numberBetween(11100, 1000000),

                    'province_id'      => $faker->numberBetween(1,63),
                    'district_id'      => $faker->numberBetween(1,700),
                    'ward_id'      => $faker->numberBetween(1,10603),
                ]
            );
        }
    }
}
