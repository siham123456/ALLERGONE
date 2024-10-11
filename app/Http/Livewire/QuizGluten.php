<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;

class QuizGluten extends Component
{
    public $questions = [];
    public $currentQuestionIndex = 0;
    public $score = 0;
    public $quizComplete = false;

    public function mount()
    {
        // Récupérer uniquement les questions liées à l'allergène "gluten"
        $this->questions = Question::where('allergen', 'gluten')->get();

        // Si aucune question n'est trouvée pour le gluten
        if ($this->questions->isEmpty()) {
            session()->flash('error', 'Aucune question trouvée pour l\'allergène gluten.');
        } else {
            // Convertir en tableau pour faciliter l'accès aux propriétés
            $this->questions = $this->questions->toArray();
        }
    }

    public function selectAnswer($userAnswer)
    {
        // Vérifier si la réponse donnée est correcte
        if ($userAnswer == $this->questions[$this->currentQuestionIndex]['correct_answer']) {
            $this->score++;
            $this->questions[$this->currentQuestionIndex]['feedback_image'] = $this->questions[$this->currentQuestionIndex]['correct_feedback_image'];
            $this->questions[$this->currentQuestionIndex]['feedback_text'] = $this->questions[$this->currentQuestionIndex]['correct_feedback_text'];
        } else {
            $this->questions[$this->currentQuestionIndex]['feedback_image'] = $this->questions[$this->currentQuestionIndex]['wrong_feedback_image'];
            $this->questions[$this->currentQuestionIndex]['feedback_text'] = $this->questions[$this->currentQuestionIndex]['wrong_feedback_text'];
        }

        // Passer à la question suivante
        $this->currentQuestionIndex++;

        // Si toutes les questions ont été traitées
        if ($this->currentQuestionIndex >= count($this->questions)) {
            $this->quizComplete = true;
        }
    }

    public function render()
    {
        return view('livewire.quiz-gluten');
    }

}


