<?php

use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => '1', 'name' => 'Food'],
            ['id' => '2', 'name' => 'Apparel'],
            ['id' => '3', 'name' => 'Crafts'],
            ['id' => '4', 'name' => 'Jewelry'],
            ['id' => '5', 'name' => 'Entertainment'],
            ['id' => '6', 'name' => 'Gardening'],
            ['id' => '7', 'name' => 'Distribution'],
            ['id' => '8', 'name' => 'Gastro'],
        ];

        foreach ($items as $item){
            \App\Category::create($item);

        }
    }
}
