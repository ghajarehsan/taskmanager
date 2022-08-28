<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Level;
use Illuminate\Database\Seeder;

class DepartmentLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = Level::get();

        Department::where('name', 'it')->first()->levels()->syncWithoutDetaching($levels);

        Department::where('name', 'marketing')->first()->levels()->syncWithoutDetaching($levels);

    }
}
