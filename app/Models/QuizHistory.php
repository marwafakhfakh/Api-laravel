<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class QuizHistory extends Model
{
    protected $table = 'quizzes_historical';
    protected $fillable = [
     'date',
     'response_time',
     'score',
     'titre'
    ];

    public function quizz()
    {
        return $this->hasMany(Quiz::class);
    }
}
