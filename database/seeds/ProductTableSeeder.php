<?php

use Illuminate\Database\Seeder;
use function GuzzleHttp\json_decode;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Faker\Provider\Internet;

class ProductTableSeeder extends Seeder
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
            DB::table('products')->insert(
                [
                    'title'        => $faker->catchPhrase,
                    'slug'         => $faker->slug,                  
                    'price'        => $faker->numberBetween(5000,50000),
                    'quantity'     => $faker->numberBetween(2,30),
                    'stock_in'     => $faker->numberBetween(2,30),
                    'stock_out'    => $faker->numberBetween(2,30),
                    'description'  => $faker->text,
                    'summary'      => $faker->text,
                    'status'       => 'active',
                    // 'size'         => 'M',
                    'discount'     => $faker->numberBetween(2,50),
                    'condition'    => 'new',
                    'is_featured'  => $faker->numberBetween(0,1),
                    'cate_id'      => $faker->numberBetween(1,12),
                    'brand_id'     => $faker->numberBetween(1,3),
                    'user_id'      => $faker->numberBetween(1,3),
                    'size_id'      => $faker->numberBetween(1,3),
                    'color_id'      => $faker->numberBetween(1,4),
                    'feature_image_path' => "/images/" . strval($faker->numberBetween(1,10)) .".jpg",
                    'feature_image_name' => $faker->name,
                ]
            );
        }
    }
}
