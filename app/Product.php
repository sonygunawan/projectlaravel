<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    // we only want these 3 attributes able to be filled
    protected $fillable = array('id','title', 'image', 'price','description','slug');
	protected $table = 'products';

	public function file()
    {
    	return $this->belongsTo('App\File');
    }
    public function setTitleAttribute($value)
	{
	    $this->attributes['title'] = $value;
	    $this->attributes['slug'] = str_slug($value);
	}

}
