<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
  //  public function show($allergen)
// {
  //  $questions = Question::where('allergen', $allergen)->get();

    // Optional: check if questions are being retrieved correctly
  //  if ($questions->isEmpty()) {
   //     dd('No questions found for the allergen: ' . $allergen);
  //  }

  //  return view('quiz.gluten', compact('questions'));
//}

// public function showQuiz($allergen)
// {
//    return view('livewire/quiz', ['allergen' => $allergen]);
// }

public function show($allergen)
{
    $questions = Question::where('allergen', $allergen)->get();

    // Optional: check if questions are being retrieved correctly
    if ($questions->isEmpty()) {
        dd('No questions found for the allergen: ' . $allergen);
    }

    return view('quiz', compact('questions', 'allergen')); // Pass both questions and allergen
}





//public function gluten(){

//    return view('quiz/gluten'); // Pass both questions and allergen

//}

public function gluten()
    {
        // Récupérer les questions pour l'allergène "gluten"
        $questions = Question::where('allergen', 'gluten')->get();

        // Retourner la vue avec les questions
        return view('quiz.gluten', compact('questions'));
    }

public function gluten1()
    {
        // Récupérer les questions pour l'allergène "gluten"
        $questions = Question::where('allergen', 'gluten')->get();

        // Retourner la vue avec les questions
        return view('quiz.gluten', compact('questions'));
    }

    public function gluten2()
{
    // Fetch questions for the allergen "gluten"
    $questions = Question::where('allergen', 'gluten')->get();

    // Return the view with the questions
    return view('quiz.gluten', compact('questions'));
}


public function gluten6()
{
    // Retrieve questions for the allergen "gluten" including the image column
    $questions = Question::where('allergen', 'gluten')->get(['id', 'text', 'image', 'correct_answer', 'correct_feedback_image', 'wrong_feedback_image', 'wrong_feedback_text', 'correct_feedback_text']);

    // Return the view with the questions
    return view('quiz.gluten', compact('questions'));
}



}

