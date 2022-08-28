<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeders = [
            [
                'name' => 'it',
                'persian_name' => 'آی تی'
            ],
            [
                'name' => 'marketing',
                'persian_name' => 'بازاریابی'
            ],
        ];

        foreach ($seeders as $seeder) {
            $department = Department::where('name', $seeder['name'])->first();
            if (!$department) {
                $department = new Department();
                $department->name = $seeder['name'];
                $department->persian_name = $seeder['persian_name'];
                $department->save();
            }
        }
    }
}
