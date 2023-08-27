<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//
        $roles = Role::all();
        $owner = User::create([
            'first_name' => 'owner',
            'last_name' => 'owner',
            'birth_date' => '2001-01-01',
            'gender' => '1',
            'phone_number' => '0999999999',
            'email' => 'learnyapp9@gmail.com',
            'password' => Hash::make('0000'),
            'verified' => true,
            'nationality_id' => 1
        ]);

        $owner->save();
        $owner->assignRole($roles->where('name','owner'));

        $teacher = User::create([
            'first_name' => 'teacher',
            'last_name' => 'admin',
            'birth_date' => '2001-01-01',
            'gender' => '1',
            'phone_number' => '0999999999',
            'email' => 'mr000games@gmail.com',
            'password' => Hash::make('0000'),
            'verified' => true,
            'nationality_id' => 1
        ]);

        $teacher->save();
        $teacher->assignRole([$roles->where('name','teacher'),$roles->where('name','admin')]);


        $wael = User::create([
            'first_name' => 'wael',
            'last_name' => 'orabi',
            'birth_date' => '2001-01-01',
            'gender' => '1',
            'phone_number' => '0999999999',
            'email' => 'waelorabi267@gmail.com',
            'password' => Hash::make('0000'),
            'verified' => true,
            'nationality_id' => 1
        ]);
        $wael->save();
        $wael->assignRole($roles->where('name','student'));

        $ayham = User::create([
            'first_name' => 'ayham',
            'last_name' => 'alrefay',
            'birth_date' => '2001-01-01',
            'gender' => '1',
            'phone_number' => '0999999999',
            'email' => 'ayhamalerfay@gmail.com',
            'password' => Hash::make('0000'),
            'verified' => true,
            'nationality_id' => 1
        ]);
        $ayham->save();
        $ayham->assignRole($roles->where('name','student'));

        $ahmed = User::create([
            'first_name' => 'ahmed',
            'last_name' => 'almaleh',
            'birth_date' => '2001-01-01',
            'gender' => '1',
            'phone_number' => '0999999999',
            'email' => 'ahmedalma173@gmail.com',
            'password' => Hash::make('0000'),
            'verified' => true,
            'nationality_id' => 1
        ]);
        $ahmed->save();
        $ahmed->assignRole($roles->where('name','student'));

        $baraa = User::create([
            'first_name' => 'baraa',
            'last_name' => 'aldomani',
            'birth_date' => '2001-01-01',
            'gender' => '1',
            'phone_number' => '0999999999',
            'email' => 'baraadom9@gmail.com',
            'password' => Hash::make('0000'),
            'verified' => true,
            'nationality_id' => 1
        ]);
        $baraa->save();
        $baraa->assignRole($roles->where('name','student'));

    }
}
