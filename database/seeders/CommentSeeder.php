<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Criterion;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users and criteria to work with
        $users = User::all();
        $criteria = Criterion::all();

        if ($users->isEmpty() || $criteria->isEmpty()) {
            $this->command->info('Please run UserSeeder and ensure there are criteria in the database first.');
            return;
        }

        // Create some parent comments
        foreach ($criteria as $criterion) {
            // Create 2-4 comments for each criterion
            $numComments = rand(2, 4);
            
            for ($i = 0; $i < $numComments; $i++) {
                $comment = Comment::create([
                    'content' => fake()->paragraph(),
                    'user_id' => $users->random()->id,
                    'commentable_id' => $criterion->id,
                    'commentable_type' => Criterion::class,
                ]);

                // Add 0-2 replies to each comment
                $numReplies = rand(0, 2);
                for ($j = 0; $j < $numReplies; $j++) {
                    Comment::create([
                        'content' => fake()->sentence(),
                        'user_id' => $users->random()->id,
                        'parent_id' => $comment->id,
                        'commentable_id' => $criterion->id,
                        'commentable_type' => Criterion::class,
                    ]);
                }
            }
        }
    }
}
