<?php

namespace Database\Seeders;

use App\Models\Project as Project;
use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i=0; $i < 50; $i++) { 
            $newProject = new Project();
            $newProject->type_id = Type::inRandomOrder()->first()->id;
            $newProject->title = $faker->unique()->realTextBetween(5,10);
            $newProject->author =$faker->realTextBetween(3,10);
            $newProject->slug = Str::slug($newProject->title);
            $newProject->content =$faker->realTextBetween(500,900);
            $newProject->project_date_start =$faker->date();
            $newProject->project_date_end =$faker->date();
            $newProject->image ='landscape.jpg';
            $newProject->save();
        }
    }
}
