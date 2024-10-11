<div class="flex items-center justify-center h-screen bg-gray-100 p-5">

<div class="story-container" >
<div >
    <head><script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script></head>
    <audio id="correctSound" src="{{ asset('Sound/correct.mp3') }}" preload="auto"></audio>
    <audio id="wrongSound" src="{{ asset('Sound/wrong.mp3') }}" preload="auto"></audio>

  

    @if ($currentStep === 0) <!-- Vérifiez si c'est la première question -->
        <h1 class="story-title">Histoire d'Hugo</h1>
    @endif

    @if (session()->has('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

  
    @if ($isCorrectAnswer == null) <!-- Afficher la question seulement si la réponse n'est pas encore correcte -->
    <h2 class="story-subtitle">{{ $stories[$currentStep]['title'] }}</h2>
    <h1 class="story-text">{{ $stories[$currentStep]['text'] }}</h1>
    <h1 class="story-question">{{ $stories[$currentStep]['question'] }}</h1>
    @endif


    <div class="options-container">
    @if ($isCorrectAnswer == null && $currentStep < count($stories) - 1) <!-- Afficher les boutons seulement si la réponse n'est pas encore correcte et ce n'est pas la dernière question -->
        <button class="option-button" wire:click="nextStep('Oui')">Oui</button>
        <button class="option-button" wire:click="nextStep('Non')">Non</button>
    @elseif ($isCorrectAnswer && $currentStep < count($stories) - 1) <!-- Si la réponse est correcte mais ce n'est pas la dernière question -->
        <!-- Les boutons ne s'affichent pas ici, ils sont masqués -->
    @elseif ($currentStep == count($stories) - 1) <!-- Si c'est la dernière question -->
    <div class="options-container" style="display: flex; align-items: center; justify-content: center; margin-top: 20px;">
    <h1 class="end-message" style="
        font-size: 1.2em; /* Taille de police légèrement plus grande */
        color: #4E3B31; /* Couleur enfantine */
        margin-right: 20px; /* Espace entre le message et le bouton */
        animation: fadeIn 1s; /* Animation d'apparition */
    ">Merci d'avoir terminé l'histoire !</h1>
    
    <a href="{{ url('/') }}">
        <button class="option-button" style="
            padding: 10px 20px; /* Espacement interne */
            font-size: 1.2em; /* Taille de police */
            background-color: #FF6F20; /* Couleur de fond */
            color: white; /* Couleur du texte */
            border: none; /* Pas de bordure */
            border-radius: 5px; /* Coins arrondis */
            cursor: pointer; /* Changer le curseur */
            transition: background-color 0.3s, transform 0.3s; /* Animation */
        ">Retour à l'accueil</button>
    </a>
</div>
@endif
</div>

    <!-- Conteneur pour afficher le personnage selon la réponse -->
    <!-- <div class="character-container"> -->
        <!-- @if ($isCorrectAnswer === true) -->
            <!-- Si la réponse est correcte, afficher le personnage heureux -->
            <!-- <img src="{{ asset('image/happy.jpg') }}" class="character happy-character" alt="Personnage content"> -->
        <!-- @elseif ($isCorrectAnswer === false) -->
            <!-- Si la réponse est incorrecte, afficher le personnage déçu -->
            <!-- <img src="{{ asset('image/sad.jpg') }}" class="character sad-character" alt="Personnage déçu"> -->
        <!-- @endif -->
    <!-- </div> -->
    
    <div id="character" style="width: 300px; height: 300px; ">
    <script>
    // Fonction pour afficher une animation en fonction de la réponse correcte ou incorrecte
    function playAnimation(isCorrect) {
        var animationData;
        
        // Choisir le bon fichier JSON en fonction de la réponse
        if (isCorrect) {
            animationData = '{{ asset('animations/happy-animation.json') }}'; // Animation de bonne réponse
        } else {
            animationData = '{{ asset('animations/sad-animation.json') }}'; // Animation de mauvaise réponse
        }

        // Charger et afficher l'animation dans le conteneur
        var anim = lottie.loadAnimation({
            container: document.getElementById('character'), // ID du conteneur
            renderer: 'svg', // Format de rendu (svg, canvas, html)
            loop: true, // Animation non répétitive
            autoplay: true, // Lecture automatique
            path: animationData // Chemin vers le fichier JSON
            
        });
    }

    // Exemple d'appel de fonction après validation d'une réponse
    window.addEventListener('responseEvent', function(event) {
        const isCorrect = event.detail.isCorrect; // Récupérer si la réponse est correcte ou non
        playAnimation(isCorrect); // Appeler la fonction avec le résultat
    });

    // Fonction pour jouer un son en fonction de la réponse correcte ou incorrecte
function playSound(isCorrect) {
    var sound;

    // Choisir le bon fichier audio en fonction de la réponse
    if (isCorrect) {
        sound = document.getElementById('correctSound'); // Son de bonne réponse
    } else{
        sound = document.getElementById('wrongSound'); // Son de mauvaise réponse
    }

    // Jouer le son
    sound.play();
}

// Exemple d'appel de la fonction après validation d'une réponse
window.addEventListener('responseEvent', function(event) {
    const isCorrect = event.detail.isCorrect; // Récupérer si la réponse est correcte ou non
    playSound(isCorrect); // Appeler la fonction avec le résultat
});

</script>

    </div>

    <!-- Affichage de la phrase de fin si elle existe -->
    @if ($currentEndPhrase)
    <h1 class="end-phrase">{{ $currentEndPhrase }}</h1>
    @endif
    <div id="endPhrase" style="
    font-size: 1.2em; /* Taille de police légèrement plus grande */
    margin-top: 20px; /* Espace au-dessus */
    color: #4E3B31; /* Couleur enfantine (Deep Sky Blue) */
    text-align: center; /* Centrer le texte */
    animation: fadeIn 1s; /* Animation d'apparition */
        "></div>
    <script>
    // Gestion de l'événement pour afficher la phrase de fin
    window.addEventListener('showEndPhrase', event => {
        const endPhraseDiv = document.getElementById('endPhrase');
        endPhraseDiv.innerText = event.detail.endPhrase;
        endPhraseDiv.style.display = 'block';
    });
    </script>

     
    @if ($isCorrectAnswer)
        <button class="next-button" 
            wire:click="advanceStep" 
            style="background-color: green; color: white;"
            onmouseover="this.style.backgroundColor='#32CD32'" onmouseout="this.style.backgroundColor='green'"
        >
            Suivant
        </button>
    @endif


    <!-- <div id="endPhrase" style="
    font-size: 1.2em; /* Taille de police légèrement plus grande */
    margin-top: 20px; /* Espace au-dessus */
    color: #4E3B31; /* Couleur enfantine (Deep Sky Blue) */
    text-align: center; /* Centrer le texte */
    animation: fadeIn 1s; /* Animation d'apparition */
        "></div> -->
 <!-- Ajoutez le code JavaScript ici -->


    </div>

    



<style>
.story-container {
    width: 90%; /* Largeur à 90% de l'écran */
    max-width: 1000px; /* Largeur maximale */
    max-height: 1200px; /* Hauteur maximale (70% de 600px) */
    overflow-y: auto; /* Autoriser le défilement interne si nécessaire */
    background-color: rgba(255, 255, 255, 0.9); /* Couleur de fond légèrement transparente */
    background-image: url('{{ asset('images/fond5.jpg') }}');
    background-size: cover; /* L'image couvre toute la surface */
    background-position: center; /* Centrer l'image de fond */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Ombre */
    border-radius: 10px; /* Coins arrondis */
    padding: 20px; /* Espacement interne */
    text-align: center; /* Centrer le texte à l'intérieur */
    transition: transform 0.3s; /* Transition pour l'effet d'agrandissement */
}

.story-container:hover {
    transform: scale(1.02); /* Légère augmentation de la taille au survol */
}
    

        /* Animation de fade-in pour l'apparition du personnage */
        @keyframes fadeInCharacter {
        from {
            opacity: 0;
            transform: scale(0.5); /* Le personnage commence petit */
        }
        to {
            opacity: 1;
            transform: scale(1); /* Le personnage grandit à sa taille normale */
        }
    }

    /* Style pour le personnage */
    .character {
        display: block;
        margin: 20px auto; /* Centrer le personnage */
        max-width: 140px; /* Taille maximum du personnage */
        animation: fadeInCharacter 1s ease-in-out; /* Animation d'apparition */
        position: absolute; /* Positionner l'animation de manière absolue */
        top: 50%; /* Déplacer vers le bas de 50% */
        left: 50%; /* Déplacer vers la droite de 50% */
        transform: translate(-50%, -50%); /* Ajuster pour centrer */
        width: 150px; /* Largeur de votre animation */
        height: 150px; /* Hauteur de votre animation */
    }

    /* Personnage heureux */
    .happy-character {
        animation-delay: 0.2s; /* Légère attente avant l'apparition */
    }

    /* Personnage déçu */
    .sad-character {
        animation-delay: 0.2s; /* Légère attente avant l'apparition */
    }


    .story-container {
        width: 100%; /* Remplir toute la largeur */
        height: auto; /* Hauteur automatique pour permettre le défilement */
        padding: 20px; /* Espacement interne */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
        animation: fadeIn 1s; /* Animation d'apparition */
        
    }

    .story-title {
        text-align: center; /* Centrer le titre */
        color: #FF6F20; /* Couleur du titre */
        font-size: 2.5em; /* Taille de police */
        margin-bottom: 20px; /* Espacement en bas */
    }

    .story-subtitle {
        text-align: center; /* Centrer le sous-titre */
        font-size: 1.5em; /* Taille de police */
        color: #4E3B31; /* Couleur du texte */
        margin: 20px 0; /* Espacement */
    }

    .story-text, .story-question {
        font-size: 1.2em; /* Taille de police */
        margin-bottom: 15px; /* Espacement en bas */
    }

    .options-container {
        display: flex; /* Utiliser flexbox */
        justify-content: center; /* Centrer horizontalement */
        margin: 20px 0; /* Espacement */
    }

    .option-button {
        background-color: #FF6F20; /* Couleur de fond */
        color: white; /* Couleur du texte */
        border: none; /* Pas de bordure */
        border-radius: 5px; /* Coins arrondis */
        padding: 10px 20px; /* Espacement interne */
        font-size: 1.1em; /* Taille de police */
        margin: 0 10px; /* Espacement latéral */
        cursor: pointer; /* Changer le curseur */
        transition: background-color 0.3s, transform 0.3s; /* Animation */
    }

    .option-button:hover {
        background-color: #CC6600; /* Couleur au survol */
        transform: scale(1.05); /* Légère augmentation de la taille au survol */
    }
    .end-phrase {
    font-size: 1.6em; /* Taille de police légèrement plus grande */
    margin-top: 20px; /* Espace au-dessus */
    color: #00BFFF; /* Couleur enfantine (Deep Sky Blue) */
    text-align: center; /* Centrer le texte */
    animation: fadeIn 1s; /* Animation d'apparition */
}
    .end-message{
    font-size: 1.2em; /* Taille de police légèrement plus grande */
    margin-top: 20px; /* Espace au-dessus */
    color: #4E3B31; /* Couleur enfantine (Deep Sky Blue) */
    text-align: center; /* Centrer le texte */
    animation: fadeIn 1s; /* Animation d'apparition */
        
}

    .next-button {
        margin-top: 20px; /* Espace au-dessus du bouton */
        padding: 10px 20px; /* Espacement interne */
        font-size: 1.2em; /* Taille de police */
        border-radius: 5px; /* Coins arrondis */
        cursor: pointer; /* Changer le curseur */
        transition: background-color 0.3s, transform 0.3s; /* Animation */
        display: block; /* Faire du bouton un élément de bloc */
        margin-left: auto; /* Marges automatiques pour l'alignement à droite */
        margin-right: 0; /* Éliminer la marge à droite */
    }

 

    @keyframes fadeIn {
        from {
            opacity: 0; /* Début transparent */
        }
        to {
            opacity: 1; /* Fin visible */
        }
    }

    .alert {
        font-size: 24px; /* Taille de police plus grande */
        font-weight: bold; /* Mettre le texte en gras */
        margin: 20px 0; /* Marge en haut et en bas */
        padding: 10px; /* Espacement intérieur */
        border-radius: 5px; /* Coins arrondis */
        text-align: center; /* Centrer le texte */
    }

    .alert-success {
        color: green; /* Couleur du texte pour le succès */
        /* border: 2px solid green; Bordure verte */
    }

    .alert-danger {
        color: #4E3B31; /* Couleur du texte pour l'erreur */
        /* border: 2px solid red; Bordure rouge */
    }

</style>
</div>