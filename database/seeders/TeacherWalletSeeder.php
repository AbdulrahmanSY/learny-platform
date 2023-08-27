<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\TeacherWallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherWalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = Teacher::where('teacher_status_id', 1)->get();
        foreach ($teachers as $teacher) {
            $appointments = $teacher->appointments->where('status_id', 3)->where('teacher_id', $teacher->id);
            foreach ($appointments as $appointment) {
                DB::table('teacher_wallets')->insert([
                    'teacher_id' => $teacher->id,
                    'number_of_hours' => 1,
                    'actual_of_hours' => 1,
                    'price' => 40,
                    'withdraw_money' => 0,
                ]);

            }
        }
    }
}
