<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['name' => 'Haircut', 'description' => 'Cắt tóc cơ bản', 'duration' => 30, 'price' => 200000],
            ['name' => 'Hair Wash', 'description' => 'Gội đầu thư giãn', 'duration' => 20, 'price' => 100000],
            ['name' => 'Hair Coloring', 'description' => 'Nhuộm tóc toàn bộ', 'duration' => 120, 'price' => 800000],
            ['name' => 'Facial', 'description' => 'Chăm sóc da mặt', 'duration' => 45, 'price' => 350000],
            ['name' => 'Massage', 'description' => 'Massage thư giãn vai gáy', 'duration' => 60, 'price' => 300000],
        ];

        foreach ($services as $service) {
            Service::create($service + ['is_active' => true]);
        }
    }
}
