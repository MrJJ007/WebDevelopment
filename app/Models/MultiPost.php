<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Relationships and setup go here
class MultiPost extends Model
{
    public function comments()
	{
		return $this->hasOne('App\Models\Comment');
	}
	public function user()
	{
		return $this->hasMany('App\Models\User');
	}
    use HasFactory;// is this needed?
    protected $casts=[
        'users'=>'array'
    ];


}
