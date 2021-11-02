<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
	protected $table = 'posts';

	/**
	 * The attributes that are mass assignable.
	 * @var array
	 */
	protected $fillable = [
		'title',
		'content',
		'Image',
		'keywords',
		'short_description',
		'active'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 * @var array
	 */
	protected $hidden = [
		'date_created', 'date_modified'
	];

}
