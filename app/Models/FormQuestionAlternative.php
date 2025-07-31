<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormQuestionAlternative extends Model
{
    use SoftDeletes;
    
    protected $table = 'form_question_alternatives';

    protected $fillable = [
        'user_id',
        'form_id', 
        'question_id', 
        'alternative_id'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }

    public function getIsActiveFormAttribute()
    {
        return $this->form->is_active;
    }
}
