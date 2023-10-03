<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name'=>'Rafi','email'=>'tanshasan@gmail.com','password'=>'123455'],
            ['name'=>'Amit','email'=>'Amit@gmail.com','password'=>'123455'],
            ['name'=>'Hasan','email'=>'hasan@gmail.com','password'=>'123455'],
            ['name'=>'Faysal','email'=>'faysal@gmail.com','password'=>'123455'],
        ];
        User::insert( $users );
    }
}
