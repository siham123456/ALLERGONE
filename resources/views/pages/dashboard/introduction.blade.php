<x-app-layout>

HELLOOOOOOOOOOO
  <section class="relative w-full h-screen flex items-center justify-center overflow-hidden">

    <!-- Media Section: Image and Video Side by Side -->
    <div class="flex w-full h-full relative z-0">

      <!-- Left: Image with Dark Overlay -->
      <div class="w-1/2 relative">
        <picture>
          <img loading="lazy" class="object-cover w-full h-full" src="{{ asset('images/cover1.jpeg') }}" alt="People sitting at table">
        </picture>
        <div class="absolute inset-0 bg-black bg-opacity-70"></div> <!-- Dark hue over the image -->
      </div>

      <!-- Right: Video -->
      <div class="w-1/2 relative">
        <button class="absolute inset-0 z-10 flex items-center justify-center bg-black bg-opacity-25 hover:bg-opacity-50 transition" aria-controls="hero-video">
          <span class="text-white text-4xl">▶</span> <!-- Play Button Icon -->
        </button>
        <video id="hero-video" class="object-cover w-full h-full" src="{{ asset('images/vid1.mp4') }}" autoplay="" loop="" muted=""></video>
      </div>

    </div>

    <!-- Text Overlay: Positioned in the center across both media -->
<div class="absolute inset-0 flex flex-col justify-center z-10 text-white p-8">
  <div class="text-lg font-semibold mb-4 text-left">LES ALLERGIES</div>
  <h1 class="text-4xl lg:text-6xl font-bold text-left">
    UNE MALADIE
    <br><span class="text-yellow-400 ">PAS UNE INTOLERANCE</span> <!-- Highlighted text -->
  </h1>
  <div class="text-left"> <!-- This will ensure the button stays left-aligned -->
    <a href="/" class="mt-10 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-6 rounded-lg transition inline-block">
      Commencer le jeu
    </a>
  </div>
</div>

    <!-- Decorative Borders -->
    <span class="absolute top-0 left-0 w-12 h-12 border-t-4 border-l-4 border-white"></span>
    <span class="absolute bottom-0 left-0 w-12 h-12 border-b-4 border-l-4 border-white"></span>
    <span class="absolute top-0 right-0 w-12 h-12 border-t-4 border-r-4 border-white"></span>
    <span class="absolute bottom-0 right-0 w-12 h-12 border-b-4 border-r-4 border-white"></span>

  </section>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-blueish-green-100">
                    <h1 class="text-3xl font-bold text-orange-600 mb-6">Gluten Adventure with Glu the Grain!</h1>
                    
                    <div class="mb-8">
                        <img src="{{ asset('images/glu-normal.png') }}" alt="Glu the Grain" class="w-32 h-32 mx-auto">
                    </div>

                    <div x-data="{ 
                        currentQuestion: 0,
                        score: 0,
                        questions: [
                            {
                                text: 'Glu wakes up and wants cereal for breakfast. Should Glu choose regular wheat cereal?',
                                answer: false
                            },
                            {
                                text: 'For lunch, Glu\'s friend offers a sandwich. Should Glu accept it without asking what\'s in it?',
                                answer: false
                            },
                            {
                                text: 'At snack time, Glu sees a fruit salad. Is it safe for Glu to eat it?',
                                answer: true
                            }
                            // Add more questions here
                        ]
                    }" x-cloak>
                        <template x-if="currentQuestion < questions.length">
                            <div>
                                <p class="text-lg mb-4" x-text="questions[currentQuestion].text"></p>
                                <div class="flex justify-center space-x-4">
                                    <button @click="checkAnswer(true)" class="px-6 py-2 bg-warm-yellow-500 text-white rounded-full hover:bg-warm-yellow-600 focus:outline-none focus:ring-2 focus:ring-warm-yellow-500 focus:ring-opacity-50 transition">
                                        Yes
                                    </button>
                                    <button @click="checkAnswer(false)" class="px-6 py-2 bg-blueish-green-500 text-white rounded-full hover:bg-blueish-green-600 focus:outline-none focus:ring-2 focus:ring-blueish-green-500 focus:ring-opacity-50 transition">
                                        No
                                    </button>
                                </div>
                            </div>
                        </template>
                        <template x-if="currentQuestion >= questions.length">
                            <div class="text-center">
                                <h2 class="text-2xl font-bold mb-4">Quiz Complete!</h2>
                                <p class="text-xl">Your score: <span x-text="score"></span> out of <span x-text="questions.length"></span></p>
                                <button @click="resetQuiz" class="mt-4 px-6 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 transition">
                                    Play Again
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function checkAnswer(userAnswer) {
            const correctAnswer = this.questions[this.currentQuestion].answer;
            const resultElement = document.createElement('div');
            resultElement.classList.add('text-center', 'mt-4', 'text-lg', 'font-bold');
            
            if (userAnswer === correctAnswer) {
                this.score++;
                resultElement.textContent = 'Correct!';
                resultElement.classList.add('text-green-600');
                document.querySelector('img').src = "{{ asset('images/glu-happy.png') }}";
            } else {
                resultElement.textContent = 'Oops! Try again!';
                resultElement.classList.add('text-red-600');
                document.querySelector('img').src = "{{ asset('images/glu-sad.png') }}";
            }
            
            this.$el.querySelector('.bg-blueish-green-100').appendChild(resultElement);
            
            setTimeout(() => {
                this.currentQuestion++;
                resultElement.remove();
                document.querySelector('img').src = "{{ asset('images/glu-normal.png') }}";
            }, 2000);
        }

        function resetQuiz() {
            this.currentQuestion = 0;
            this.score = 0;
        }
    </script>
    @endpush

</x-app-layout>