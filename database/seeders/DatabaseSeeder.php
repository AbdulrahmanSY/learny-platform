<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Answers;
use App\Models\CardID;
use App\Models\Certificate;
use App\Models\Day;
use App\Models\Language;
use App\Models\PlatformServices;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Teacher;
use App\Models\TeacherInfo;
use App\Models\TeacherLanguage;
use App\Models\User;
use App\Models\WorkingDay;
use App\Models\WorkingTime;
use Database\Factories\CardIDFactory;
use Database\Factories\RoleUserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(DaySeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(TeacherStatusSeed::class);
        $this->call(CertificateTypeSeeder::class);
        $this->call(DonerTypeSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AppointmentStatusSeeder::class);
        $this->call(PeriodSeed::class);
        $this->call(GoalSeed::class);
        $this->call(TeacherSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ContentLevelSeeder::class);
        $this->call(ParagraphCategorieSeeder::class);
        $this->call(TypePostSeeder::class);
        $this->call(ParagraphSeeder::class);
        $this->call(QuestionsSeeder::class);
        $this->call(PlatformServicesSeeder::class);
        $this->call(PriceHourSeeder::class);
        $this->call(PackageHoursSeeder::class);
        $this->call(PlatformInformationSeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(TeacherWalletSeeder::class);
        $this->call(PostSeeder::class);



    }
}
