<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        Question::create([
            'allergen' => 'gluten',
            'text' => 'Is it safe for someone with gluten allergy to eat regular bread?',
            'correct_answer' => false,
            'correct_feedback_image' => 'path/to/happy_face.jpg',
            'correct_feedback_text' => 'Correct! It is not safe for someone with a gluten allergy to eat regular bread.',
            'wrong_feedback_image' => 'path/to/sad_face.jpg',
            'wrong_feedback_text' => 'Oops! That\'s not right. Regular bread contains gluten.',
        ]);

        Question::create([
            'allergen' => 'gluten',
            'text' => 'Can someone with celiac disease eat rice?',
            'correct_answer' => true,
            'correct_feedback_image' => 'path/to/happy_face.jpg',
            'correct_feedback_text' => 'Correct! Rice is safe for someone with celiac disease.',
            'wrong_feedback_image' => 'path/to/sad_face.jpg',
            'wrong_feedback_text' => 'Oops! That\'s not right. Rice is safe to eat.',
        ]);

        Question::create([
            'allergen' => 'gluten',
            'text' => 'Is oatmeal always gluten-free?',
            'correct_answer' => false,
            'correct_feedback_image' => 'path/to/happy_face.jpg',
            'correct_feedback_text' => 'Correct! Oatmeal can contain gluten if processed in a facility that also processes gluten products.',
            'wrong_feedback_image' => 'path/to/sad_face.jpg',
            'wrong_feedback_text' => 'Oops! That\'s not right. Oatmeal can contain gluten if not certified gluten-free.',
        ]);
    }
}
