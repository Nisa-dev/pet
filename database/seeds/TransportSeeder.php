<?php

use Illuminate\Database\Seeder;
use App\Transport;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transport::create([
            'transport_name' => 'รถขนไก่',
            'transport_price' => '100',
            'transport_count' => '0',
        ]);

        Transport::create([
            'transport_name' => 'รถคาร์โก้',
            'transport_price' => '200',
            'transport_count' => '0',
        ]);

        Transport::create([
            'transport_name' => 'การบินไทย',
            'transport_price' => '300',
            'transport_count' => '0',
        ]);
        
        Transport::create([
            'transport_name' => 'นกแอร์',
            'transport_price' => '400',
            'transport_count' => '0',
        ]);

    }
}
