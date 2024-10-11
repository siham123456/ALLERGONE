<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;

class Quiz extends Component
{
    public $questions;
    public $currentQuestionIndex = 0;
    public $score = 0;
    public $showFeedback = false;
    public $feedbackText = '';
    public $lastAnswerCorrect = false;
    public $quizComplete = false;

    public function mount($allergen)
    {
        $this->questions = Question::where('allergen', $allergen)->get();
    }

    public function checkAnswer($userAnswer)
    {
        $correctAnswer = $this->questions[$this->currentQuestionIndex]->correct_answer;
        $this->lastAnswerCorrect = $userAnswer == $correctAnswer;

        if ($this->lastAnswerCorrect) {
            $this->score++;
            $this->feedbackText = 'Correct! Well done!';
        } else {
            $this->feedbackText = 'Oops! That\'s not right!';
        }

        $this->showFeedback = true;

        // Automatically move to the next question after a delay
        sleep(2);
        $this->nextQuestion();
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
            $this->showFeedback = false;
        } else {
            $this->quizComplete = true;
        }
    }

    public function resetQuiz()
    {
        $this->currentQuestionIndex = 0;
        $this->score = 0;
        $this->quizComplete = false;
        $this->showFeedback = false;
    }

    public function render()
    {
        return view('livewire.quiz');
    }
}
