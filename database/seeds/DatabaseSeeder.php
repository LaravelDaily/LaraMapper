<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(CitySeed::class);
        $this->call(ShopSeed::class);
        $this->call(CategorySeed::class);
        $this->call(MediaSeed::class);
        $this->call(CategoryStoreSeed::class);

    }
}
