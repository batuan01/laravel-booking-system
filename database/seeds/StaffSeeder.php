<?php

use Illuminate\Database\Seeder;
use App\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staffs = [
            ['name' => 'Nguyễn Văn A', 'email' => 'a@booking.test', 'phone' => '0900000001'],
            ['name' => 'Nguyễn Văn B', 'email' => 'b@booking.test', 'phone' => '0900000002'],
            ['name' => 'Trần Văn C', 'email' => 'c@booking.test', 'phone' => '0900000003'],
        ];

        foreach ($staffs as $staff) {
            Staff::create($staff + ['is_active' => true]);
        }
    }
}
