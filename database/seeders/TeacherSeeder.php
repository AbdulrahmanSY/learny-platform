<?php

namespace Database\Seeders;

use App\Models\CardID;
use App\Models\Certificate;
use App\Models\Day;
use App\Models\Language;
use App\Models\Teacher;
use App\Models\TeacherInfo;
use App\Models\User;
use App\Models\WorkingTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(50)
            ->has(Teacher::factory(1)
                ->has(CardID::factory(1), 'cardId')
                ->has(TeacherInfo::factory(1), 'info')
            )
            ->create()
            ->each(function ($user) {

                $languages = Language::inRandomOrder()->take(3)->get();
                $teacherLanguages = $languages->map(function ($language) use ($user) {
                    return [
                        'language_id' => $language->id,
                        'teacher_id' => $user->teacher->id,
                        'years_of_experience' => rand(2, 15),
                        'language_level_id' => rand(4, 6)
                    ];
                });
                $user->teacher->languages()->createMany($teacherLanguages->toArray())
                    ->each(function ($teacherLanguage) {
                        $certificates = Certificate::factory(2)->make([
                            'teacher_language_id' => $teacherLanguage->id
                        ])->toArray();
                        $teacherLanguage->certificates()->createMany($certificates);
                    });

                $days = Day::inRandomOrder()->take(3)->get();
                $workingDays = $days->map(function ($day) use ($user) {
                    return [
                        'day_id' => $day->id,
                        'teacher_id' => $user->teacher->id
                    ];
                });
                $user->teacher->workingDays()->createMany($workingDays->toArray())
                    ->each(function ($workingDay) {
                        $workingTimes = WorkingTime::factory(1)->make([
                            'working_day_id' => $workingDay->id
                        ])->toArray();
                        $workingDay->workingTimes()->createMany($workingTimes);
                    });
                $user->roles()->attach([4, 3]);
                $user->nationality_id = 1;
            });

    }
}
