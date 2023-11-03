<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Niveau extends Model
{
    use HasFactory;
    protected $table = 'niveau';
    protected $fillable = [
     'nom',
     'prénom'
    ];
    public function quizz()
    {
        return $this->hasMany(Quiz::class);
    }

}
