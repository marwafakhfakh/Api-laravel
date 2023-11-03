<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends Model
{
    use HasFactory;
    protected $table = 'options';
    protected $fillable = [
     'name',
     'value',
     'question_id'
    ];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
