<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\Rent;
use App\Models\Zwrot;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        /*Schema::withoutForeignKeyConstraints(function () {
            Zwrot::truncate();
            Rent::truncate();
            User::truncate();
        });*/


        User::insert(
            [
              [
                  'brand_id' => 1, 'email' => 'jan@email.com',
                  'name' => 'Jan', 'password' => Hash::make('1234'),
                  'role_id' => 1,
              ],
              [
                  'brand_id' => 2, 'email' => 'albert@email.com',
                  'name' => 'Albert', 'password' => Hash::make('1234'),
                  'role_id'=>2
              ],
              [
                  'brand_id' => 3, 'email' => 'heniek@email.com',
                  'name' => 'Heniek', 'password' => Hash::make('1234'),
                  'role_id'=>2
              ],
              [
                  'brand_id' => 3, 'email' => 'marta@email.com',
                  'name' => 'Marta', 'password' => Hash::make('1234'),
                  'role_id'=>2
              ],
              [
                  'brand_id' => 4, 'email' => 'wlodzimierz@email.com',
                  'name' => 'Włodzimierz', 'password' => Hash::make('1234'),
                  'role_id'=>2
              ],
              [
                  'brand_id' => 5, 'email' => 'antygona@email.com',
                  'name' => 'Antygona', 'password' =>Hash::make('1234'),
                  'role_id'=>2
              ],
              [
                  'brand_id' => 6, 'email' => 'gerwazy@email.com',
                  'name' => 'Gerwazy', 'password' =>Hash::make('1234'),
                  'role_id'=>2
              ],
              [
                  'brand_id' => 7, 'email' => 'seweryn@email.com',
                  'name' => 'Seweryn', 'password' =>Hash::make('1234'),
                  'role_id'=>2
              ],
              [
                  'brand_id' => 8, 'email' => 'jeremiasz@email.com',
                  'name' => 'Jeremiasz', 'password' =>Hash::make('1234'),
                  'role_id'=>2
              ],
              [
                'brand_id' => 1,'email' => 'test@email.com',
                'name' => 'Tester', 'password' =>Hash::make('1234'),
                'role_id'=>3
              ],
              [
                'brand_id' => 1,'email' => 'krzysztof2@email.com',
                'name' => 'Krzysztof', 'password' =>Hash::make('1234'),
                'role_id'=>3
              ],
              [
                'brand_id' => 1,'email' => 'olga@email.com',
                'name' => 'Olga', 'password' =>Hash::make('1234'),
                'role_id'=>3
              ],
              [
                'brand_id' => 1,'email' => 'arek@email.com',
                'name' => 'Arek', 'password' =>Hash::make('1234'),
                'role_id'=>3
              ],
              [
                'brand_id' => 1,'email' => 'olgierd@email.com',
                'name' => 'Olgierd', 'password' =>Hash::make('1234'),
                'role_id'=>3
              ],
              [
                'brand_id' => 1,'email' => 'elzbieta@email.com',
                'name' => 'Elżbieta', 'password' =>Hash::make('1234'),
                'role_id'=>3
              ],
              [
                'brand_id' => 1,'email' => 'waclaw@email.com',
                'name' => 'Wacław', 'password' =>Hash::make('1234'),
                'role_id'=>3
              ]
            ]
        );
    }
}
