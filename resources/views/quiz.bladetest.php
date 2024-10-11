
    <div class="quiz-container">
        <!-- Livewire component for the quiz -->
        <livewire:quiz :allergen="$allergen" />

        <!-- Content inside the layout -->
        @if (count($questions) > 0)
            <div class="question text-center">
                <!-- Image placed before the question -->
                <img src="{{ asset('images/' . $questions[$currentQuestionIndex]['allergen'] . '.jpg') }}" 
                     alt="{{ $questions[$currentQuestionIndex]['allergen'] }}" 
                     class="mx-auto my-4 w-24 h-24" /> <!-- Adjust the size here -->

                <h2 class="text-2xl font-bold">{{ $questions[$currentQuestionIndex]['text'] }}</h2>
            </div>

            <div class="answer-buttons flex justify-center space-x-4 mt-4">
                <button wire:click="checkAnswer(true)" class="px-6 py-4 bg-green-500 text-white rounded hover:bg-green-600 transition">
                    Yes
                </button>
                <button wire:click="checkAnswer(false)" class="px-6 py-4 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    No
                </button>
            </div>

            @if ($showFeedback)
                <div class="feedback mt-4 text-center">
                    <p class="{{ $lastAnswerCorrect ? 'text-green-600' : 'text-red-600' }} font-bold">
                        {{ $feedbackText }}
                    </p>
                    @if ($lastAnswerCorrect)
                        <button wire:click="nextQuestion" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Next Question
                        </button>
                    @else
                        <button wire:click="retryQuestion" class="mt-4 px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition">
                            Answer Again
                        </button>
                    @endif
                </div>
            @endif

        @else
            <p>No questions available for this allergen.</p>
        @endif

        @if ($quizComplete)
            <div class="quiz-complete text-center">
                <h2 class="text-3xl font-bold mb-4">Great Job!</h2>
                <p class="text-xl">Your score: {{ $score }} out of {{ count($questions) }}</p>
                <button wire:click="showSummary" class="mt-4 px-6 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 transition">
                    See All Right Answers
                </button>
            </div>
        @endif

        @if ($summaryVisible)
            <div class="summary mt-4">
                <h3 class="text-2xl font-bold">Summary of Questions</h3>
                <ul class="mt-2">
                    @foreach ($questions as $index => $question)
                        <li>
                            <strong>Question {{ $index + 1 }}:</strong> {{ $question['text'] }} <br>
                            <strong>Your Answer:</strong> {{ $question['userAnswer'] ? 'Yes' : 'No' }} <br>
                            <strong>Correct Answer:</strong> {{ $question['correct_answer'] ? 'Yes' : 'No' }} <br>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    @push('styles')
    <style>
        .quiz-container {
            padding: 20px;
        }
        .question img {
            width: 100px; /* Set the image width */
            height: 100px; /* Set the image height */
            object-fit: cover; /* Maintain aspect ratio */
        }
    </style>
    @endpush

    <!-- Add Livewire Scripts and Styles -->
    @livewireStyles
    @livewireScripts

