<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
    	'title',
    	'url',
    	'description'
    ];

    /**
    *Film ma swojego autora
    */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    /**
    * Video ma wiele kategorii
    */
    public function categories()
    {
    	return $this->belongsToMany('App\Category')->withTimestamps();
    }

    /**
    * Lista ID kategorii dla video
    */
    public function getCategoryListAttribute()
    {
    	return $this->categories->pluck('id')->all();
    }
}
