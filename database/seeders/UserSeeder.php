<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin;
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'typham2@gmail.com';
        $admin->email_verified_at = now();
        $admin->password = '';
        $admin->remember_token = Str::random(10);
        $admin->created_at = now();
        $admin->updated_at = now();
        $admin->original = null;
        $admin->medium = null;
        $admin->thumbnail = null;
        $admin->cover_original = null;
        $admin->cover_medium = null;
        $admin->cover_thumbnail = null;
        $admin->save();

        // Role;
        $admin->roles()->sync([1]);

        $admin->setPasswordAttribute('k*77TnT9H^aTGg');
        $admin->save();
    }
}
