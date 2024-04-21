<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deliveries = [
            'UPS',
            'FedEx Corporation',
            'DHL Express',
            'USPS',
            'Royal Mail',
            'Canada Post',
            'Australia Post',
            'Japan Post',
            'La Poste',
            'Deutsche Post DHL Group'
        ];

        foreach ($deliveries as $el) {

            $newArr = [
                'name' => $el
            ];

            $exist = DB::table('deliveries')->select('id')->where(['name' => $el])->exists();

            if (!$exist) {
                DB::table('deliveries')->insert($newArr);
            }
        }
    }
}
