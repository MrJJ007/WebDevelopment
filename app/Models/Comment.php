<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post()
	{
		return $this->belongsTo('App\Models\Post');
	}
	public function user()
	{
		return $this->belongsTo('App\Models\User');
    }
    public function upvotes()
    {
        return $this->morphMany(Upvote::class, 'upvoteable');
    }
    use HasFactory;//is this needed?
}
