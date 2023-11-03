<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quizz';
    protected $fillable =[
        'titre',
        'description',
        'image',
        'categorie_id',
        'historique_id',
        'niveau_id'
    ];

    public function categoies()
    {
        return $this->belongsTo(Category::class);
    }

    public function quizzes_historical()
    {
        return $this->belongsTo(QuizHistory::class);
    }
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
    public function question()
    {
        return $this->hasMany(Question::class);
    }
}


