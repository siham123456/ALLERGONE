<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question; // Assuming you have a Question model
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Quiz extends Component
{
    public $currentQuestion;
    public $currentQuestionIndex = 0;
    public $showFeedback = false;
    public $isCorrectAnswer = null;

    public function mount()
    {
        // Fetch the first question from the DB when the component mounts
        $this->loadQuestion();
    }

    public function loadQuestion()
    {
        // Fetch the current question based on the index
        $this->currentQuestion = Question::skip($this->currentQuestionIndex)->first();
        $this->showFeedback = false; // Hide feedback when loading new question
        $this->isCorrectAnswer = null; // Reset answer state
    }

    public function submitAnswer($answer)
    {
        // Check if the answer matches the correct_answer field
        if ($answer == $this->currentQuestion->correct_answer) {
            $this->isCorrectAnswer = true;
        } else {
            $this->isCorrectAnswer = false;
        }
        $this->showFeedback = true; // Show feedback after answering
    }

    public function nextQuestion()
    {
        $this->currentQuestionIndex++; // Move to the next question
        $this->loadQuestion(); // Load the next question
    }

    public function answerAgain()
    {
        $this->showFeedback = false; // Hide feedback to retry
        $this->isCorrectAnswer = null; // Reset answer state
    }

    public function render()
    {
        return view('livewire.quiz');
    }
}
