<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i<11; $i++)
        {
            DB::table('media')->insert([
                'id' => $i,
                'model_id' => $i,
                'model_type' => 'App\Store',
                'collection_name' => 'photo',
                'name' => $i,
                'file_name' => "$i.jpeg",
                'mime_type' => 'image/jpeg',
                'disk' => 'public',
                'size' => $i,
                'manipulations' => '[]',
                'custom_properties' => '[]'
            ]);
        }
    }
}
