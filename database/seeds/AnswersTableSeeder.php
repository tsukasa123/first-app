<?php

use Illuminate\Database\Seeder;
use App\Answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Answer::create([
                'user_id' => 1,
                'question_id' => $i,
                'text' => 'This is test answer '. $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
