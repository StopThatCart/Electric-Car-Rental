<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Zwrot;
use App\Models\Rent;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       /* Schema::withoutForeignKeyConstraints(function () {
            Zwrot::truncate();
            Rent::truncate();
            Car::truncate();
        });*/


        Car::insert(
            [
              [
                    'brand_id' => '2', 'model' => 'T-3',
                    'description' => 'Model idealny do jazdy bez trzymanki. Automatyczne prowadzenie doprowadzi cię do celu, podczas gdy ty możesz odpocząć np. grając w swoją ulubioną grę na panelu Tesli.',
                    'description_en' => 'The perfect model for hands-free driving. Automatic driving will take you to your destination while you can relax, for example, by playing your favorite game on the Tesla panel.',
                    'year'=>'2021', 'battery' => '60', 'seats' => '4',
                    'gear' => 'Automatic', 'img' => 't3.jpg'
              ],
              [
                    'brand_id' => '3', 'model' => 'X-5 M',
                    'description' => 'Marzy ci się jazda w góry? Ten Model idealnie sprawdzi się na tych drogach. Dzięki ocieplanym siedzeniom i grubej stali możesz jeździć przez dziury w drogach bez większych wstrząsów.',
                    'description_en' => 'Dreaming of driving in the mountains? This model is perfect for those roads. With heated seats and thick steel, you can drive over potholes without major shocks.',
                    'year'=>'2018', 'battery' => '50', 'seats' => '5',
                    'gear' => 'Manual', 'img' => 'x5.jpg'
              ],
              [
                    'brand_id' => '4', 'model' => 'EQC',
                    'description' => 'Dzięki dużemu zasięgowi, obszernej infrastrukturze ładowania i bezpieczeństwu na najwyższym poziomie model EQC daje nam nowe poczucie elektrycznej jazdy.',
                    'description_en' => 'Thanks to its long range, extensive charging infrastructure, and top-level safety, the EQC model gives us a new sense of electric driving.',
                    'year'=>'2022', 'battery' => '96.4', 'seats' => '4',
                    'gear' => 'Manual', 'img' => 'eqc.jpg'
              ],
              [
                    'brand_id' => '5', 'model' => 'e-Soul',
                    'description' => 'Przestronne wnętrze pełne przeróżnego wyposażenia gwarantuje ci komfortową jazdę po mieście. Działa cicho, a efektywnie. Idealny do wieczornej jazdy po mieście.',
                    'description_en' => 'The spacious interior filled with various amenities ensures a comfortable city driving experience. It operates quietly and efficiently, making it perfect for evening drives in the city.',
                    'year'=>'2020', 'battery' => '67', 'seats' => '5',
                    'gear' => 'Automatic', 'img' => 'esoul.jpg'
              ],
              [
                    'brand_id' => '6', 'model' => 'Mach-E',
                    'description' => 'Imponujący zasięg, natychmiastowe przyspieszenie, rewolucyjny design. Zawsze innowacyjny technologicznie, dzięki automatycznym aktualizacjom. Wejdź na wyższy poziom elektromobilności.',
                    'description_en' => 'Impressive range, instant acceleration, revolutionary design. Always technologically innovative with automatic updates. Take electric mobility to the next level.',
                    'year'=>'2021', 'battery' => '88', 'seats' => '4',
                    'gear' => 'Manual', 'img' => 'mache.jpg'
              ],
              [
                    'brand_id' => '7', 'model' => 'Q4 e-tron',
                    'description' => 'Auto o imponującym zakresie jazdy i dynamicznym designie. Luksusowe wnętrze i innowacyjne technologie tworzą wyjątkowe doświadczenie podróżowania.',
                    'description_en' => 'A car with an impressive driving range and dynamic design. Luxurious interior and innovative technologies create a unique travel experience.',
                    'year'=>'2019', 'battery' => '76.6', 'seats' => '5',
                    'gear' => 'Manual', 'img' => 'etron.jpg'
              ],
              [
                    'brand_id' => '8', 'model' => 'LEAF',
                    'description' => 'Niezły zasięg jazdy, dzięki czemu rzadko będziesz musiał go ładować. Posiada inteligentny system nawigacji, zaawansowany system zarządzania energią i eleganckie wnętrze.',
                    'description_en' => 'A decent driving range, so you will not have to charge it often. It features intelligent navigation system, advanced energy management system, and elegant interior.',
                    'year'=>'2020', 'battery' => '74.2', 'seats' => '5',
                    'gear' => 'Automatic', 'img' => 'leaf.jpg'
              ],
              [
                    'brand_id' => '2', 'model' => 'T-SFX',
                    'description' => 'Wnętrze przyszłości. Kinowe wrażenie. Pozwól autopilotowi kierować i spędź miło podróż.',
                    'description_en' => 'The interior of the future. Cinematic experience. Let the autopilot take the wheel and enjoy a pleasant journey.',
                    'year'=>'2023', 'battery' => '80.6', 'seats' => '5',
                    'gear' => 'Automatic', 'img' => 'tsfx.jpg'
              ],
              [
                    'brand_id' => '3', 'model' => 'IX-3',
                    'description' => 'Bardzo bogate wyposażenie i wysoka jakość wykonania. Jedź bez obaw.',
                    'description_en' => 'Very rich equipment and high quality craftsmanship. Drive without worries.',
                    'year'=>'2019', 'battery' => '86.1', 'seats' => '6',
                    'gear' => 'Manual', 'img' => 'ix3.jpg'
              ],
              [
                    'brand_id' => '4', 'model' => 'AMG',
                    'description' => 'Najwyższy możliwy luksus. Najlepsza możliwa jakość. Najlepsze ocieplane siedzenia.',
                    'description_en' => 'The highest possible luxury. The best possible quality. The best heated seats.',
                    'year'=>'2021', 'battery' => '41.7', 'seats' => '7',
                    'gear' => 'Manual', 'img' => 'amg.jpg'
              ],
              [
                    'brand_id' => '5', 'model' => 'EV9',
                    'description' => 'Istny filar designu. Najlepszy towar na rynku. Przynajmniej do czasu.',
                    'description_en' => 'A true pillar of design. The best product on the market. At least for now.',
                    'year'=>'2023', 'battery' => '73.3', 'seats' => '5',
                    'gear' => 'Manual', 'img' => 'ev9.jpg'
              ],
              [
                    'brand_id' => '6', 'model' => 'Explorer',
                    'description' => 'Stworzony do jazdy po mieście i poza nim. Odkryj nowe miejsca. Idealny na wakacje z rodzina.',
                    'description_en' => 'Designed for city and off-road driving. Discover new places. Perfect for family vacations.',
                    'year'=>'2022', 'battery' => '54.6', 'seats' => '7',
                    'gear' => 'Manual', 'img' => 'explorer.jpg'
              ],
              [
                    'brand_id' => '7', 'model' => 'RS-RTV',
                    'description' => 'W sumie to niczym się zbytnio nie różni. Przynajmniej tani.',
                    'description_en' => 'Well, it is not really different. At least it is affordable.',
                    'year'=>'2018', 'battery' => '39.4', 'seats' => '4',
                    'gear' => 'Automatic', 'img' => 'rsrtv.jpg'
              ],
              [
                    'brand_id' => '8', 'model' => 'GRASS',
                    'description' => 'Wielka prędkość. Pojemna bateria. Gwarantowane bezpieczeństwo. A to wszystko w tym małym samochodzie.',
                    'description_en' => 'High speed. Large battery. Guaranteed safety. And all of that in this small car.',
                    'year'=>'2022', 'battery' => '99.9', 'seats' => '1',
                    'gear' => 'Automatic', 'img' => 'grass.jpg'
              ]
            ]
        );
    }
}
