<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryStoreSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 20) as $index) {
            DB::table('category_store')->insert([
                'category_id' => rand(1, 8),
                'store_id' => rand(1, 10)
            ]);
        }
    }
}
