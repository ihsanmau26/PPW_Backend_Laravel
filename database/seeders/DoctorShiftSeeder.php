<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\DoctorShift;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoctorShift::create(['doctor_id' => 1, 'shift_id' => 1]);
        DoctorShift::create(['doctor_id' => 1, 'shift_id' => 2]);
        DoctorShift::create(['doctor_id' => 1, 'shift_id' => 3]);
        DoctorShift::create(['doctor_id' => 1, 'shift_id' => 4]);
        DoctorShift::create(['doctor_id' => 1, 'shift_id' => 5]);
        DoctorShift::create(['doctor_id' => 1, 'shift_id' => 6]);
        DoctorShift::create(['doctor_id' => 1, 'shift_id' => 7]);
        DoctorShift::create(['doctor_id' => 1, 'shift_id' => 8]);
        DoctorShift::create(['doctor_id' => 1, 'shift_id' => 9]);
    }
}
