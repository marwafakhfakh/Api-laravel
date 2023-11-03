<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizz', function (Blueprint $table)
         {
            $table->id();
            $table->string('image');
            $table->string('titre');
            $table->string('description');
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('historique_id');
            $table->unsignedBigInteger('niveau_id');
            $table->timestamps();
            
           
            $table->foreign('historique_id')
            ->references('id')->on('quizzes_historical');

            $table->foreign('categorie_id')
            ->references('id')->on('categories'); 

            $table->foreign('niveau_id')
            ->references('id')->on('niveau'); 

          

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizz');
    }
};
