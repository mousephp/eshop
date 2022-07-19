<?php

use Illuminate\Database\Seeder;
use function GuzzleHttp\json_decode;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Faker\Provider\Internet;

class PostTableSeeder extends Seeder
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
            DB::table('posts')->insert(
                [
                    'title'        => $faker->catchPhrase,
                    'photo'        => "/images/" . strval($faker->numberBetween(1,10)) .".jpg",
                    'photo_name'   => $faker->name,
                    'summary'      => $faker->text,
                    'quote'        => $faker->text,
                    'description'  => $faker->text,
                    'status'       => 'active',
                    'slug'         => $faker->slug,
                    'post_cate_id' => $faker->numberBetween(1,4),
                    'user_id'      => $faker->numberBetween(1,3),
                ]
            );
        }
    }
}
