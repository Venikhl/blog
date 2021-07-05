<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::query()
            ->create([
                'name' => 'Администратор',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'is_admin' => true
            ]);

        $user->markEmailAsVerified();
    }
}
