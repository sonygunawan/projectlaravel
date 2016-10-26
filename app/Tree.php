<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    // we only want these 3 attributes able to be filled
    protected $fillable = array('type', 'age', 'bear_id');

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function bear() {
        return $this->belongsTo('App\Bear');
    }
}
