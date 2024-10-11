<?php

namespace App\Http\Livewire;

use App\Models\Story;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class QuestionStoryComponent extends Component
{
    public $stories;
    public $currentStep = 0;
    public $correctAnswerGiven = false;

    public function mount()
{
    // $this->stories = Story::select('title', 'text', 'question', 'options', 'correct_answer', 'end_phrase')->get()->toArray();
    $this->stories = Story::all()->toArray();

    // Décode les options JSON
    foreach ($this->stories as &$story) {
        $story['options'] = json_decode($story['options'], true);
    }
}



public $currentEndPhrase = null;

public $isCorrectAnswer = null; // Pour stocker si la réponse est correcte ou non
public function nextStep($answer)
{
    // Vérifiez si la réponse donnée est correcte
    if ($answer == $this->stories[$this->currentStep]['correct_answer']) {
        $this->isCorrectAnswer = true;

        $this->dispatch('responseEvent', isCorrect: $this->isCorrectAnswer);
        session()->flash('success', 'Bravo, bonne réponse!');
        

        // Si une phrase de fin existe, déclenchez l'événement pour l'afficher
        if (isset($this->stories[$this->currentStep]['end_phrase'])) {
            $this->dispatch('showEndPhrase', endPhrase: $this->stories[$this->currentStep]['end_phrase']);
        } else {
            $this->isCorrectAnswer = false; // La réponse est incorrecte
            $this->dispatch('error', message: 'Réponse incorrecte! essayez encore.');
        }

    }
}


public function advanceStep()
{
    // L'utilisateur ne peut avancer que si la réponse est correcte
    if ($this->isCorrectAnswer) {
        // Passe à la question suivante
        $this->currentStep++;
        $this->isCorrectAnswer = null; // Réinitialiser pour la prochaine question

        // Vérifiez si nous avons atteint la fin de l'histoire
        if ($this->currentStep >= count($this->stories)) {
            $this->currentStep = 0; // Réinitialiser pour recommencer ou rediriger
        }
    }
}


    public function render()
    {
        return view('livewire.question-story-component');
    }
}
