<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    
    protected $fillable = array('filename', 'mime', 'original_filename');
	protected $table = 'files';


}
