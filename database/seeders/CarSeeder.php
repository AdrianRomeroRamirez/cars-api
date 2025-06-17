<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Color;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Red', 'code' => '3R3'],
            ['name' => 'Black', 'code' => '202'],
            ['name' => 'White', 'code' => '040'],
            ['name' => 'Gray', 'code' => '1G3'],
            ['name' => 'Blue', 'code' => '8X2'],
        ];

        $colorIds = collect($colors)->map(function ($item) {
            return Color::firstOrCreate(
                ['name' => $item['name']],
                ['code' => $item['code']]
            )->id;
        });

        $cars = [
            [
                'brand' => 'Toyota',
                'model' => 'Corolla',
                'year' => 2020,
                'engine_type' => 'gasoline',
                'description' => 'Reliable compact sedan',
                'colors' => ['White', 'Black']
            ],
            [
                'brand' => 'Tesla',
                'model' => 'Model 3',
                'year' => 2023,
                'engine_type' => 'electric',
                'description' => 'High-performance electric sedan',
                'colors' => ['Red', 'White']
            ],
            [
                'brand' => 'Ford',
                'model' => 'Mustang',
                'year' => 2019,
                'engine_type' => 'gasoline',
                'description' => 'Classic muscle car',
                'colors' => ['Red', 'Gray']
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'Ioniq 5',
                'year' => 2022,
                'engine_type' => 'electric',
                'description' => 'Electric SUV with retro-futuristic design',
                'colors' => ['Blue', 'Gray']
            ]
        ];

        foreach ($cars as $data) {
            $car = Car::create([
                'brand' => $data['brand'],
                'model' => $data['model'],
                'year' => $data['year'],
                'engine_type' => $data['engine_type'],
                'description' => $data['description'],
            ]);

            $ids = collect($data['colors'])
                ->map(fn($name) => Color::where('name', $name)->first()->id);

            $car->colors()->sync($ids);
        }
    }
}
