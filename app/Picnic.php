<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picnic extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    // we only want these 3 attributes able to be filled
    protected $fillable = array('name', 'taste_level');

    // DEFINE RELATIONSHIPS --------------------------------------------------
    // define a many to many relationship
    // also call the linking table
    public function bears() {
        return $this->belongsToMany('App\Bear', 'bears_picnics', 'picnic_id', 'bear_id');
    }

}
