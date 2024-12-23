<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

use App\Models\Rent;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Zwrot::truncate();

        Rent::insert(
            [
             [
                    'offer_id' => '1', 'user_id' => '10', 'cost' => '252.67',
                    'date_rent' => Carbon::create(2022, 11, 12),
                    'date_return' => Carbon::create(2022, 11, 15),
                    'state' => 'Returned'
              ],
              [
                    'offer_id' => '2', 'user_id' => '14', 'cost' => '222.33',
                    'date_rent' => Carbon::create(2023, 03, 21),
                    'date_return' => Carbon::create(2023, 03, 24),
                    'state' => 'Canceled'
              ],
              [
                    'offer_id' => '4', 'user_id' => '11', 'cost' => '427.11',
                    'date_rent' => Carbon::create(2023, 01, 18),
                    'date_return' => Carbon::create(2023, 01, 24),
                    'state' => 'Canceled'
              ],
              [
                    'offer_id' => '5', 'user_id' => '12', 'cost' => '222.33',
                    'date_rent' => Carbon::create(2023, 02, 1),
                    'date_return' => Carbon::create(2023, 02, 8),
                    'state' => 'Canceled'
              ],
              [
                    'offer_id' => '7', 'user_id' => '13', 'cost' => '832.51',
                    'date_rent' => Carbon::create(2023, 02, 5),
                    'date_return' => Carbon::create(2023, 02, 14),
                    'state' => 'Returned'
              ],
              [
                    'offer_id' => '12', 'user_id' => '13', 'cost' => '442.44',
                    'date_rent' => Carbon::create(2023, 03, 4),
                    'date_return' => Carbon::create(2023, 03, 11),
                    'state' => 'Rented'
              ],
              [
                    'offer_id' => '15', 'user_id' => '14', 'cost' => '222.33',
                    'date_rent' => Carbon::create(2023, 03, 21),
                    'date_return' => Carbon::create(2023, 03, 24),
                    'state' => 'Returned'
              ],
              [
                'offer_id' => '29', 'user_id' => '14', 'cost' => '2130.99',
                'date_rent' => Carbon::create(2021, 03, 18),
                'date_return' => Carbon::create(2021, 04, 2),
                'state' => 'Returned'
              ],
              [
                'offer_id' => '31', 'user_id' => '13', 'cost' => '299.28',
                'date_rent' => Carbon::create(2023, 06, 7),
                'date_return' => Carbon::create(2023, 06, 10),
                'state' => 'Waiting for you'
              ],
              [
                'offer_id' => '35', 'user_id' => '12', 'cost' => '572.16',
                'date_rent' => Carbon::create(2022, 06, 6),
                'date_return' => Carbon::create(2022, 06, 13),
                'state' => 'Canceled'
              ],
              [
                'offer_id' => '40', 'user_id' => '14', 'cost' => '299.28',
                'date_rent' => Carbon::create(2022, 07, 16),
                'date_return' => Carbon::create(2022, 07, 19),
                'state' => 'Returned'
              ],
              [
                'offer_id' => '3', 'user_id' => '14', 'cost' => '222.33',
                'date_rent' => Carbon::create(2023, 03, 12),
                'date_return' => Carbon::create(2023, 03, 15),
                'state' => 'Waiting for you'
          ],
          [
                'offer_id' => '6', 'user_id' => '12', 'cost' => '521.35',
                'date_rent' => Carbon::create(2023, 06, 9),
                'date_return' => Carbon::create(2023, 06, 23),
                'state' => 'Rented'
          ],
          [
                'offer_id' => '21', 'user_id' => '15', 'cost' => '1213.26',
                'date_rent' => Carbon::create(2023, 06, 8),
                'date_return' => Carbon::create(2023, 06, 22),
                'state' => 'In progress'
          ],
          [
                'offer_id' => '22', 'user_id' => '16', 'cost' => '189.85',
                'date_rent' => Carbon::create(2023, 06, 7),
                'date_return' => Carbon::create(2023, 06, 10),
                'state' => 'Rented'
          ],
          [
                'offer_id' => '26', 'user_id' => '11', 'cost' => '2130.99',
                'date_rent' => Carbon::create(2023, 05, 18),
                'date_return' => Carbon::create(2023, 06, 1),
                'state' => 'Rented'
          ],
          [
            'offer_id' => '10', 'user_id' => '10', 'cost' => '333.31',
            'date_rent' => Carbon::create(2023, 06, 5),
            'date_return' => Carbon::create(2023, 06, 8),
            'state' => 'Rented'
          ]

        ]
        );
    }
}
