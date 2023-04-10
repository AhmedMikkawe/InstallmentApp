<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'super-admin']);
        User::create([
            "fullname" => "Admin",
            "username" => "admin",
            "email" => "admin@gmail.com",
            "password"=> Hash::make("123456"),
            "nationalId" => "1234567",
            "nationalId_photo"=>  "",
            "phone_number"=> "1234567"
        ]);
        $user = User::with('roles')->where('email','admin@gmail.com')->first();
        $user->assignRole('super-admin');
    }
}
