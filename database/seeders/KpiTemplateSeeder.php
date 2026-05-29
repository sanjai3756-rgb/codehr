<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\KpiTemplate;
use App\Models\KpiCategory;
use App\Models\KpiQuestion;

class KpiTemplateSeeder extends Seeder
{
    public function run(): void
    {

        /*
        |--------------------------------------------------------------------------
        | PHP DEVELOPER
        |--------------------------------------------------------------------------
        */

        $php = KpiTemplate::create([

            'role' => 'PHP Developer'

        ]);


        $cat1 = KpiCategory::create([

            'template_id' => $php->id,
            'category' => 'Technical Skills',
            'weightage' => 40

        ]);


        $questions1 = [

            'Code Quality',
            'Laravel Knowledge',
            'Database Handling',
            'API Integration',
            'Bug Fixing'

        ];


        foreach($questions1 as $q){

            KpiQuestion::create([

                'category_id' => $cat1->id,
                'question' => $q

            ]);

        }



        $cat2 = KpiCategory::create([

            'template_id' => $php->id,
            'category' => 'Productivity',
            'weightage' => 30

        ]);


        $questions2 = [

            'Task Completion',
            'Deadline Management',
            'Git Usage'

        ];


        foreach($questions2 as $q){

            KpiQuestion::create([

                'category_id' => $cat2->id,
                'question' => $q

            ]);

        }



        $cat3 = KpiCategory::create([

            'template_id' => $php->id,
            'category' => 'Behaviour',
            'weightage' => 30

        ]);


        $questions3 = [

            'Communication',
            'Team Work',
            'Attendance'

        ];


        foreach($questions3 as $q){

            KpiQuestion::create([

                'category_id' => $cat3->id,
                'question' => $q

            ]);

        }






        /*
        |--------------------------------------------------------------------------
        | FLUTTER DEVELOPER
        |--------------------------------------------------------------------------
        */

        $flutter = KpiTemplate::create([

            'role' => 'Flutter Developer'

        ]);


        $flutterCat = KpiCategory::create([

            'template_id' => $flutter->id,
            'category' => 'Flutter Skills',
            'weightage' => 50

        ]);


        $flutterQuestions = [

            'UI Development',
            'API Integration',
            'Firebase',
            'Performance',
            'Bug Fixing'

        ];


        foreach($flutterQuestions as $q){

            KpiQuestion::create([

                'category_id' => $flutterCat->id,
                'question' => $q

            ]);

        }






        /*
        |--------------------------------------------------------------------------
        | UI UX
        |--------------------------------------------------------------------------
        */

        $uiux = KpiTemplate::create([

            'role' => 'UI/UX Designer'

        ]);


        $uiuxCat = KpiCategory::create([

            'template_id' => $uiux->id,
            'category' => 'Design Skills',
            'weightage' => 100

        ]);


        $uiuxQuestions = [

            'Wireframe',
            'UI Creativity',
            'Figma Skills',
            'Prototype',
            'User Experience'

        ];


        foreach($uiuxQuestions as $q){

            KpiQuestion::create([

                'category_id' => $uiuxCat->id,
                'question' => $q

            ]);

        }






        /*
        |--------------------------------------------------------------------------
        | VIDEO EDITOR
        |--------------------------------------------------------------------------
        */

        $video = KpiTemplate::create([

            'role' => 'Video Editor'

        ]);


        $videoCat = KpiCategory::create([

            'template_id' => $video->id,
            'category' => 'Editing Skills',
            'weightage' => 100

        ]);


        $videoQuestions = [

            'Creativity',
            'Transitions',
            'Audio Sync',
            'Reel Editing',
            'Deadline Handling'

        ];


        foreach($videoQuestions as $q){

            KpiQuestion::create([

                'category_id' => $videoCat->id,
                'question' => $q

            ]);

        }






        /*
        |--------------------------------------------------------------------------
        | HR
        |--------------------------------------------------------------------------
        */

        $hr = KpiTemplate::create([

            'role' => 'HR'

        ]);


        $hrCat = KpiCategory::create([

            'template_id' => $hr->id,
            'category' => 'HR Skills',
            'weightage' => 100

        ]);


        $hrQuestions = [

            'Hiring Process',
            'Communication',
            'Documentation',
            'Employee Handling',
            'Attendance'

        ];


        foreach($hrQuestions as $q){

            KpiQuestion::create([

                'category_id' => $hrCat->id,
                'question' => $q

            ]);

        }

    }
}