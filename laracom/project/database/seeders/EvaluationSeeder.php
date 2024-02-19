<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker; // Fakerのインポートを追加

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); 

        $evaluations = []; 

        for ($i = 0; $i < 10; $i++) {
            $evaluations[] = [
                'product_id' => $faker->numberBetween(1, 50), // 1から50の間の商品ID
                'customer_id' => $faker->numberBetween(1, 50), // 1から50の間の顧客ID
                'evaluat' => $faker->numberBetween(1, 5), // 1から5の間の評価
                'comment' => $faker->sentence, // ランダムなコメント
                'created_at' => now(), // 現在の日付と時間
                'updated_at' => now(), // 現在の日付と時間
            ];
        }

        // デモデータの挿入
        DB::table('evaluations')->insert($evaluations);
    }
}
