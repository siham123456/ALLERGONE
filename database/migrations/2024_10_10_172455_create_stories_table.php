<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    // public function up()
    // {
    //     Schema::create('stories', function (Blueprint $table) {
    //         $table->id();
    //         $table->text('text');
    //         $table->string('question');
    //         $table->json('options'); // Utiliser JSON pour stocker plusieurs options
    //         $table->string('correct_answer');
    //         $table->timestamps();
    //     });
    // }
    public function up()
{
    Schema::create('stories', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Titre de la partie
        $table->text('text');
        $table->string('question');
        $table->json('options');
        $table->string('correct_answer');
        $table->string('end_phrase'); // Phrase de fin
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('stories');
    }
}

