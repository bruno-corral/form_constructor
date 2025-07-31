<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questions';

    protected $fillable = [
        'form_id',
        'title',
        'type',
    ];

    public function form() 
    {
        return $this->belongsTo(Form::class);
    }
    
    public function alternatives() 
    {
        return $this->hasMany(Alternative::class);
    }
}
