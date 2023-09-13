<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Entity;
use App\Models\Jobtitle;
use App\Models\User;
use App\Models\Worker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()->times(3)->create();
        User::factory()->times(8)->create();
        Worker::factory()->times(8)->create();
        Jobtitle::factory()->times(8)->create();
        Entity::factory()->times(5)->create()->each( function($entity){
            $entity->worker()->sync(
                Worker::all()->random(3)
            );
            $entity->jobtitle()->sync(
            Jobtitle::all()->random(3)
            );

        });




        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
