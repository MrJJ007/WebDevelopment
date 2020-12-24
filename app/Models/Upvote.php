<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upvote extends Model
{
    public function upvoteable()
    {
        return $this->morphTo();
    }
    use HasFactory;
}
