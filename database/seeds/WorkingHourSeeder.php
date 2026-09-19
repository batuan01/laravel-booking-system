<?php

use Illuminate\Database\Seeder;
use App\Staff;
use App\WorkingHour;

class WorkingHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Quy ước day_of_week: 0=Sunday, 1=Monday, ..., 6=Saturday.
     *
     * @return void
     */
    public function run()
    {
        // Mon-Fri 09:00-18:00, Saturday 09:00-15:00, Sunday nghỉ (không có bản ghi).
        $schedule = [
            1 => ['09:00:00', '18:00:00'],
            2 => ['09:00:00', '18:00:00'],
            3 => ['09:00:00', '18:00:00'],
            4 => ['09:00:00', '18:00:00'],
            5 => ['09:00:00', '18:00:00'],
            6 => ['09:00:00', '15:00:00'],
        ];

        Staff::all()->each(function (Staff $staff) use ($schedule) {
            foreach ($schedule as $dayOfWeek => $hours) {
                WorkingHour::create([
                    'staff_id' => $staff->id,
                    'day_of_week' => $dayOfWeek,
                    'start_time' => $hours[0],
                    'end_time' => $hours[1],
                ]);
            }
        });
    }
}
