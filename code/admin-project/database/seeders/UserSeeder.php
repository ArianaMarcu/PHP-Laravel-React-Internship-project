<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory(100)->create(); ///a inserat in baza de date 100 de useri random
//        DB::table('users')->insert([
//            'name' => Str::random(10),
//            'email' => Str::random(10).'@example.com',
//            'password' => Hash::make('password'),
//        ]);
    }
}
