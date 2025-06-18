<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Color;
use App\Models\Feature;
use App\Models\Manufacturer;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manufacturers = [
            ['name' => 'Tesla', 'country' => 'USA'],
            ['name' => 'Toyota', 'country' => 'Japan'],
            ['name' => 'Ford', 'country' => 'USA'],
        ];

        foreach ($manufacturers as $data) {
            Manufacturer::firstOrCreate($data);
        }

        $colors = [
            ['name' => 'Red', 'code' => '3R3'],
            ['name' => 'Black', 'code' => '202'],
            ['name' => 'White', 'code' => '040'],
            ['name' => 'Gray', 'code' => '1G3'],
            ['name' => 'Blue', 'code' => '8X2'],
        ];

        foreach ($colors as $data) {
            Color::firstOrCreate(['name' => $data['name']], ['code' => $data['code']]);
        }

        $features = [
            'Autopilot', 'Navigation', 'Sunroof', 'Hybrid', 'Sport Package'
        ];

        foreach ($features as $name) {
            Feature::firstOrCreate(['name' => $name]);
        }

        $cars = [
            [
                'manufacturer' => 'Tesla',
                'model' => 'Model S',
                'year' => 2022,
                'engine_type' => 'electric',
                'description' => 'Luxury electric sedan',
                'colors' => ['Red', 'Black'],
                'features' => ['Autopilot', 'Navigation']
            ],
            [
                'manufacturer' => 'Toyota',
                'model' => 'Prius',
                'year' => 2021,
                'engine_type' => 'hybrid',
                'description' => 'Efficient hybrid car',
                'colors' => ['White', 'Gray'],
                'features' => ['Hybrid', 'Navigation']
            ],
            [
                'manufacturer' => 'Ford',
                'model' => 'Mustang',
                'year' => 2019,
                'engine_type' => 'gasoline',
                'description' => 'Classic American muscle',
                'colors' => ['Red', 'Blue'],
                'features' => ['Sport Package']
            ],
            [
                'manufacturer' => 'Tesla',
                'model' => 'Model Y',
                'year' => 2023,
                'engine_type' => 'electric',
                'description' => 'Compact electric SUV',
                'colors' => ['White', 'Black'],
                'features' => ['Autopilot', 'Sunroof']
            ],
        ];

        foreach ($cars as $data) {
            $manufacturer = Manufacturer::where('name', $data['manufacturer'])->first();

            $car = Car::create([
                'manufacturer_id' => $manufacturer->id,
                'model' => $data['model'],
                'year' => $data['year'],
                'engine_type' => $data['engine_type'],
                'description' => $data['description'],
            ]);

            $colorIds = Color::whereIn('name', $data['colors'])->pluck('id');
            $featureIds = Feature::whereIn('name', $data['features'])->pluck('id');

            $car->colors()->sync($colorIds);
            $car->features()->sync($featureIds);
        }
    }
}
