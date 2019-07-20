<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Result extends Model 
{

    protected $table = 'result';
    public $timestamps = true;
    protected $fillable = array('user_id',  'questions','answers','score');
    protected $visible = array('user_id', 'questions','answers','score');

}
