<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';
    protected $fillable =[
        'text',
        'number',
        'option',
        'quiz_id'
    ];
    public function option()
    {
        return $this->hasMany(Option::class);
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    
}
