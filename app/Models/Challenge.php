<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Challenge extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    public function creator(): BelongsTo
    {

        return $this->belongsTo(User::class, 'created_by');
    }
    public function submissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Submission::class);
    }
}
