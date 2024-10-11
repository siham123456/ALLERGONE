<?php

namespace  App\Http\Livewire;

use App\Models\Question; // Import your Question model
use Livewire\Component;

class Quiz extends Component
{
    public $allergen;
    public $questions;
    public $currentQuestionIndex = 0;
    // public $score = 0;
    // public $quizComplete = false;



    public function mount($allergen)
    {
        // Fetch questions based on allergen
        $this->questions = Question::where('allergen', $allergen)->get()->toArray();
        
        // Add userAnswer field to each question
        foreach ($this->questions as &$question) {
            $question['userAnswer'] = null; // Initialize userAnswer
        }
    }

    public function checkAnswer($userAnswer)
    {
        // Store user answer (if needed for scoring)
        $this->questions[$this->currentQuestionIndex]['userAnswer'] = $userAnswer;

        // Automatically move to the next question
        $this->nextQuestion();
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
        } else {
            $this->quizComplete = true; // Finish the quiz
        }
    }

    public function render()
    {
        return view('livewire.quiz');
    }
}
