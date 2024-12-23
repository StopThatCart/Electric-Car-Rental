<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Offer;


class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offer::insert(
            [
              ['car_id' => '1', 'period' => '3', 'price' => '289.99'], ['car_id' => '1', 'period' => '7', 'price' => '489.99'], ['car_id' => '1', 'period' => '14', 'price' => '689.99'],
              ['car_id' => '2', 'period' => '3', 'price' => '136.12'], ['car_id' => '2', 'period' => '7', 'price' => '362.63'], ['car_id' => '2', 'period' => '14', 'price' => '521.35'],
              ['car_id' => '3', 'period' => '3', 'price' => '463.99'], ['car_id' => '3', 'period' => '7', 'price' => '525.99'], [ 'car_id' => '3', 'period' => '14', 'price' => '612.99'],
              ['car_id' => '4', 'period' => '3', 'price' => '333.31'], ['car_id' => '4', 'period' => '7', 'price' => '444.41'], ['car_id' => '4', 'period' => '14', 'price' => '667.61'],
              ['car_id' => '5', 'period' => '3', 'price' => '221.35'], ['car_id' => '5', 'period' => '7', 'price' => '521.83'], ['car_id' => '5', 'period' => '14', 'price' => '731.75'],
              ['car_id' => '6', 'period' => '3', 'price' => '213.89'], ['car_id' => '6', 'period' => '7', 'price' => '321.61'], ['car_id' => '6', 'period' => '14', 'price' => '500.09'],
              ['car_id' => '7', 'period' => '3', 'price' => '851.88'], ['car_id' => '7', 'period' => '7', 'price' => '1000.25'], ['car_id' => '7', 'period' => '14', 'price' => '1213.26'],
              ['car_id' => '8', 'period' => '3', 'price' => '111.18'], ['car_id' => '8', 'period' => '7', 'price' => '189.85'], ['car_id' => '8', 'period' => '14', 'price' => '309.99'],
              ['car_id' => '9', 'period' => '3', 'price' => '877.16'], ['car_id' => '9', 'period' => '7', 'price' => '1492.72'], ['car_id' => '9', 'period' => '14', 'price' => '2130.99'],
              ['car_id' => '10', 'period' => '3', 'price' => '90.66'], ['car_id' => '10', 'period' => '7', 'price' => '146.92'], ['car_id' => '10', 'period' => '14', 'price' => '233.84'],
              ['car_id' => '11', 'period' => '3', 'price' => '299.28'], ['car_id' => '11', 'period' => '7', 'price' => '572.16'], ['car_id' => '11', 'period' => '14', 'price' => '721.75'],
              ['car_id' => '12', 'period' => '3', 'price' => '631.52'], ['car_id' => '12', 'period' => '7', 'price' => '952.11'], ['car_id' => '12', 'period' => '14', 'price' => '1192.52'],
              ['car_id' => '13', 'period' => '3', 'price' => '444.42'], ['car_id' => '13', 'period' => '7', 'price' => '665.56'], ['car_id' => '13', 'period' => '14', 'price' => '777.77'],
              ['car_id' => '14', 'period' => '3', 'price' => '212.7'], ['car_id' => '14', 'period' => '7', 'price' => '316.51'], ['car_id' => '14', 'period' => '14', 'price' => '381.99'],
            ]
        );
    }
}
