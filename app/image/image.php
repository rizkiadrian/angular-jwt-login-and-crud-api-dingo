<?php

namespace App\image;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
     protected $table = 'images';
     protected $fillable = ['author','image_description','image_extension','image_path'];
     
}
