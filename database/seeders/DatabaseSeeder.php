<?php

namespace Database\Seeders;

// use App\Models\Utility;

use App\Models\MainStandard;
use App\Models\SubStandard;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \Artisan::call('module:migrate LandingPage');
        // \Artisan::call('module:seed LandingPage');
        // $this->call(UsersTableSeeder::class);
        // $this->call(PlansTableSeeder::class);

        // if (\Request::route()->getName() != 'LaravelUpdater::database') {
        //     $this->call(UsersTableSeeder::class);
        //     $this->call(PlansTableSeeder::class);
        // } else {
        //     Utility::languagecreate();
        // }

        $subStandards = [
            [
                'main_standard_id' => 1,
                'sequence' => 1,
                'name_ar' => 'المعيار الفرعي الأول',
                'name_en' => 'Sub-Standard One',
                'description_ar' => 'هذا هو الوصف للمعيار الفرعي الأول باللغة العربية.',
                'description_en' => 'This is the description for Sub-Standard One in English.',
            ],
            [
                'main_standard_id' => 1,
                'sequence' => 2,
                'name_ar' => 'المعيار الفرعي الثاني',
                'name_en' => 'Sub-Standard Two',
                'description_ar' => 'هذا هو الوصف للمعيار الفرعي الثاني باللغة العربية.',
                'description_en' => 'This is the description for Sub-Standard Two in English.',
            ],
        ];

        foreach ($subStandards as $subStandard) {
            SubStandard::create($subStandard);
        }

    }
}
