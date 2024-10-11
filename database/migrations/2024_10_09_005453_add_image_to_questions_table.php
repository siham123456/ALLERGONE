<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToQuestionsTable extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            // Adding the image column
            $table->string('image')->nullable(); // Use nullable if you want to allow questions without images
        });
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            // Dropping the image column
            $table->dropColumn('image');
        });
    }
}
