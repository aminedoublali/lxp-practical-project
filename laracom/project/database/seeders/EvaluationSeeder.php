<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // デモデータの作成
        $evaluation = [
            [
                'product_id' => 1,
                'customer_id' => 1,
                'evaluat' => 5,
                'comment' => 'This product is amazing!',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'customer_id' => 2,
                'evaluat' => 4,
                'comment' => 'Great product, but could be improved.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // 他のデモデータを追加する場合はここに追加します
        ];

        // デモデータの挿入
        DB::table('evaluations')->insert($evaluation);
    }
}
