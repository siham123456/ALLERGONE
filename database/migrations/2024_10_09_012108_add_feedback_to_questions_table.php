<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeedbackToQuestionsTable extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            // Adding columns for feedback images and text
            $table->string('correct_feedback_image')->nullable();
            $table->text('correct_feedback_text')->nullable();
            $table->string('wrong_feedback_image')->nullable();
            $table->text('wrong_feedback_text')->nullable();
        });
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            // Dropping feedback columns if the migration is rolled back
            $table->dropColumn(['correct_feedback_image', 'correct_feedback_text', 'wrong_feedback_image', 'wrong_feedback_text']);
        });
    }
}
