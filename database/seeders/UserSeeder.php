<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'ehsan',
                'email' => 'ghajar@yahoo.com',
                'department_id' => Department::where('name', 'it')->first()->id,
                'level_id' => Level::where('name', 'admin')->first()->id
            ],
            [
                'name' => 'tayebi',
                'email' => 'tayebi@yahoo.com',
                'department_id' => Department::where('name', 'marketing')->first()->id,
                'level_id' => Level::where('name', 'admin')->first()->id
            ],
            [
                'name' => 'sadegh',
                'email' => 'sadegh@yahoo.com',
                'department_id' => Department::where('name', 'it')->first()->id,
                'level_id' => Level::where('name', 'expert')->first()->id
            ],
        ];

        foreach ($seeders as $seed) {
            $user = User::where('email', $seed['email'])->first();
            if (!$user) {
                $user = new User();
                $user->name = $seed['name'];
                $user->email = $seed['email'];
                $user->department_id = $seed['department_id'];
                $user->level_id = $seed['level_id'];
                $user->password = Hash::make('ehsanTest');
                $user->save();
            }
        }

    }
}
