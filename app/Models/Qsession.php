<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qsession extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
        'score',
        'quiz_id',
        'equipe_id',
        'duration',
    ];

    public function equipe(){
        return $this->belongsTo(Equipe::class);
    }

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }
}
