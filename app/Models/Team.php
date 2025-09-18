<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
     protected $fillable = [
        'title',
        'sub_title',
        'image',
        'twitter',
        'facebook',
        'linkedin',
    ];
}
