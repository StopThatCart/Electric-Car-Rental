<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::insert(
            [
              [
                    'brand' => 'None'
              ],
              [
                    'brand' => 'Tesla'
              ],
              [
                    'brand' => 'BMW'
              ],
              [
                    'brand' => 'Mercedes'
              ],
              [
                    'brand' => 'Kia'
              ],
              [
                    'brand' => 'Ford'
              ],
              [
                    'brand' => 'Audi'
              ],
              [
                    'brand' => 'Nissan'
              ]
            ]
        );
    }
}
