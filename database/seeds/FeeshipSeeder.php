<?php

use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use Faker\Factory;
use Illuminate\Database\Seeder;

class FeeshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $province = Province::all();
        $district = District::all();
        $ward = Ward::all();

        $faker = Factory::create();

        for ($i = 0; $i < $district->count(); $i++) {
            DB::table('feeships')->insert(
                [
                    // 'code_province' => $province[$i]->gso_id,
                    'code_district' => $district[$i]->gso_id,
                    // 'code_ward' => $ward[2]->gso_id,
                    // 'fee_feeship' => $faker->numberBetween(10000, 100000),
                ]
            );
        }
    }
}
