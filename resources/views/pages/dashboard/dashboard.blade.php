<x-app-layout>
      
        <!-- INTRODUCTION -->
        
        <section class="relative w-full h-screen flex items-center justify-center overflow-hidden">

    <!-- Media Section: Image and Video Side by Side -->
    <div class="flex w-full h-full relative z-0">

      <!-- Left: Image with Dark Overlay -->
      <div class="w-1/2 relative">
        <picture>
          <img loading="lazy" class="object-cover w-full h-full justify-center" src="{{ asset('images/gueri.jpeg') }}" alt="People sitting at table">
        </picture>
        <div class="absolute inset-0 bg-black bg-opacity-80"></div> <!-- Dark hue over the image -->
      </div>

     <!-- Right: Video -->
<div class="w-1/2 relative overflow-hidden"> <!-- Add overflow-hidden to prevent any overflow -->
  <button class="absolute inset-0 z-10 flex items-center justify-center bg-black bg-opacity-25 hover:bg-opacity-50 transition" aria-controls="hero-video">
    <span class="text-white text-4xl">▶</span> <!-- Play Button Icon -->
  </button>
  <video id="hero-video" class="object-cover w-full h-full" src="{{ asset('images/vid1.mp4') }}" autoplay="" loop="" muted="" style="max-width: 100%; min-height: 100%;"></video>
</div>
    </div>

    <!-- Text Overlay: Positioned in the center across both media -->
<div class="absolute inset-0 flex flex-col justify-center z-10 text-white p-8">
  <div class="text-lg font-semibold mb-4 text-left">UNE ALLERGIE</div>
  <h1 class="text-4xl lg:text-6xl font-bold text-left">
    UNE MALADIE
    <br><span class="text-yellow-400 ">PAS UNE INTOLERANCE</span> <!-- Highlighted text -->
  </h1>
  <div class="text-left"> <!-- This will ensure the button stays left-aligned -->
    <a href="{{ route('quizzes.index') }}" class="mt-10 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-6 rounded-lg transition inline-block">
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

   
</x-app-layout>
