<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Question::create([
                'user_id' => $i,
                'text' => 'This is test ' . $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
