<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    // protected $table = 'articles';
    // public $timestamps = false;
    protected $fillable = ['username'];
    // protected $dates = [];
}
