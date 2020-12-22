<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Relationships and setup go here
class Post extends Model
{
    public function comments()
	{
		return $this->hasMany('App\Models\Comment');
	}
	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
    use HasFactory;// is this needed?
}
