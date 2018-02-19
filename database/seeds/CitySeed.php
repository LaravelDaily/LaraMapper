<?php

use Illuminate\Database\Seeder;

class CitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => '1', 'name' => 'New York',],

        ];

        foreach ($items as $item) {
            \App\City::create($item);
        }
    }
}
