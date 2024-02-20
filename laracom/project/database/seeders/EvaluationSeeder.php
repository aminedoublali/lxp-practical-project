<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationSeeder extends Seeder
{
    public function run()
    {
        
        $faker = \Faker\Factory::create();

        // デモデータの挿入
        for ($i = 0; $i < 50; $i++) {
            DB::table('evaluations')->insert([
                'product_id' => $faker->numberBetween(1, 10),
                'customer_id' => $faker->numberBetween(1, 6),
                'evaluation' => $faker->numberBetween(1, 5),
                'comment' => $faker->text(100),
            ]);
        }
    }
}
