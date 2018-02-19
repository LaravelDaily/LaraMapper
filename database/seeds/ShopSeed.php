<?php

use Illuminate\Database\Seeder;

class ShopSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => '1', 'name' => 'Modell Sporting Goods', 'description' => '<p>Family-operated chain supplying athletic equipment, footwear &amp; apparel, plus replica jerseys.</p>', 'address_address' => '280 Broadway, New York, NY, United States', 'address_latitude' => '40.71416639999999', 'address_longitude' => '-74.00568550000003', 'phone' => '12127328484', 'city_id' => '1',],
            ['id' => '2', 'name' => 'Pilgrim New York', 'description' => '<p>Store with high-end, NYC-made women&#39;s clothing, plus vintage items from well-known luxury labels.</p>', 'address_address' => '70 Orchard St, New York, NY, United States', 'address_latitude' => '40.71748399999999', 'address_longitude' => '-73.99031880000001', 'phone' => '12124637720', 'city_id' => '1',],
            ['id' => '3', 'name' => 'CityStore', 'description' => '<p>Souvenir shop featuring New York&ndash;related merchandise, including books, apparel &amp; diverse gifts.</p>', 'address_address' => '1 Centre St, New York, NY, United States', 'address_latitude' => '40.7130276', 'address_longitude' => '-74.0037529', 'phone' => '12123860007', 'city_id' => '1',],
            ['id' => '4', 'name' => 'Abercrombie & Fitch', 'description' => '<p>American fashion brand known for its trendy &amp; collegiate-inspired casualwear &amp; accessories.</p>', 'address_address' => '199 Water Street, New York, NY, United States', 'address_latitude' => '40.706937', 'address_longitude' => '-74.00448560000001', 'phone' => '12128090789', 'city_id' => '1',],
            ['id' => '5', 'name' => 'Ina', 'description' => '<p>High-end thrift store for men carrying pre-owned designer apparel, shoes &amp; accessories.</p>', 'address_address' => '19 Prince Street, New York, NY, United States', 'address_latitude' => '40.72287619999999', 'address_longitude' => '-73.99429509999999', 'phone' => '12123342210', 'city_id' => '1',],
            ['id' => '6', 'name' => 'Anthropologie', 'description' => '<p>Chain selling boho-chic womenswear, shoes, accessories &amp; home decor (some feature wedding attire).</p>', 'address_address' => '195 Broadway, New York, NY, United States', 'address_latitude' => '40.71109999999999', 'address_longitude' => '-74.0093', 'phone' => '12123853647', 'city_id' => '1',],
            ['id' => '7', 'name' => 'FIKA', 'description' => '<p>Scandinavian inspired coffeehouse offers cafe fare, chocolate &amp; snacks in a modern bustling space.</p>', 'address_address' => '66 Pearl street Loft style apartments, Pearl Street, New York, NY, United States', 'address_latitude' => '40.7034852', 'address_longitude' => '-74.0108313', 'phone' => '16468376588', 'city_id' => '1',],
            ['id' => '8', 'name' => 'Rosie Pope Maternity and Baby', 'description' => '<p>East Coast flagship store for a buzzy brand of maternity clothes, nursing supplies &amp; baby clothes.</p>', 'address_address' => '55 Warren Street, New York, NY, United States', 'address_latitude' => '40.71460260000001', 'address_longitude' => '-74.00939849999997', 'phone' => '12122133393', 'city_id' => '1',],
            ['id' => '9', 'name' => 'Labor Skateboard Shop', 'description' => '<p>Local skate shop carrying decks, trucks, wheels, accessories, apparel &amp; footwear from many brands.</p>', 'address_address' => '46 Canal Street, New York, NY, United States', 'address_latitude' => '40.71460950000001', 'address_longitude' => '-73.99162760000002', 'phone' => '16463516792', 'city_id' => '1',],
            ['id' => '10', 'name' => 'Midtown Comics Downtown', 'description' => '<p>Store featuring a variety of comic &amp; manga books, in addition to collectibles &amp; apparel.</p>', 'address_address' => '64 Fulton Street, New York, NY, United States', 'address_latitude' => '40.7087321', 'address_longitude' => '-74.0053527', 'phone' => '12123028189', 'city_id' => '1',],

        ];

        foreach ($items as $item) {
            \App\Store::create($item);

        }
    }
}
