<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable(['challenge_id', 'answer'])]
class Submission extends Model
{

    protected $fillable = [
        'challenge_id',
        'answer',
    ];


    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
