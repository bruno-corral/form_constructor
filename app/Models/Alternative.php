<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alternative extends Model
{
    use SoftDeletes;
    
    protected $table = 'alternatives';

    protected $fillable = [
        'question_id',
        'title',
        'is_correct',
    ];

    public function question() 
    {
        return $this->belongsTo(Question::class);
    }
}
