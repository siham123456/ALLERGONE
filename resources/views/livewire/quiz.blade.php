<div>
    <!-- Show the question image if available -->
    @if($currentQuestion)
        <div>
            @if ($currentQuestion->correct_feedback_image)
                <img src="{{ asset('storage/' . $currentQuestion->correct_feedback_image) }}" alt="Question Image" class="w-full h-auto">
            @endif
            
            <!-- Show the question text -->
            <p style="font-size: 24px; font-weight: bold; margin-top: 20px;">
                {{ $currentQuestion->text }}
            </p>

            <!-- Answer buttons (Yes and No) -->
            @if($isCorrectAnswer === null && !$showFeedback)
                <div>
                    <button wire:click="submitAnswer(1)" class="px-4 py-2 bg-blue-500 text-white">Yes</button>
                    <button wire:click="submitAnswer(0)" class="px-4 py-2 bg-blue-500 text-white">No</button>
                </div>
            @endif

            <!-- Feedback Section -->
            @if($showFeedback)
                @if($isCorrectAnswer)
                    <!-- Correct Answer Feedback -->
                    @if($currentQuestion->correct_feedback_image)
                        <img src="{{ asset('public/images/' . $currentQuestion->correct_feedback_image) }}" alt="Correct Feedback Image" class="w-full h-auto mt-4">
                    @endif
                    <p style="color: green; font-weight: bold; margin-top: 10px;">
                        {{ $currentQuestion->correct_feedback_text }}
                    </p>
                    <!-- Button to go to the next question -->
                    <button wire:click="nextQuestion" class="px-4 py-2 bg-green-500 text-white mt-4">Next Question</button>
                @else
                    <!-- Wrong Answer Feedback -->
                    @if($currentQuestion->wrong_feedback_image)
                        <img src="{{ asset('storage/' . $currentQuestion->wrong_feedback_image) }}" alt="Wrong Feedback Image" class="w-full h-auto mt-4">
                    @endif
                    <p style="color: red; font-weight: bold; margin-top: 10px;">
                        {{ $currentQuestion->wrong_feedback_text }}
                    </p>
                    <!-- Button to try again -->
                    <button wire:click="answerAgain" class="px-4 py-2 bg-red-500 text-white mt-4">Answer Again</button>
                @endif
            @endif
        </div>
    @else
        <!-- If no more questions -->
        <p>No more questions available.</p>
    @endif
</div>
