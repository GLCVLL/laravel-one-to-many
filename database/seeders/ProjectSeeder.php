<?php

namespace Database\Seeders;

use App\Models\Project;

use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $project = new Project();
            $project->title = $faker->text(30);
            $project->description = $faker->paragraphs(3, true);
            $project->cover_image = $faker->imageUrl();
            $project->start_date = $faker->date;
            $project->end_date = $faker->date;
            $project->category = $faker->word;
            $project->technologies = $faker->words(3, true);
            $project->project_url = $faker->url;
            $project->github_url = $faker->url;
            $project->client = $faker->name;
            $project->role = $faker->word;
            $project->additional_notes = $faker->paragraph;
            $project->visibility = $faker->boolean;
            $project->save();
        };
    }
}
