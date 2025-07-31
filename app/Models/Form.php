<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $table = 'forms';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'is_active',
    ];

    public function questions() 
    {
        return $this->hasMany(Question::class);
    }
}
