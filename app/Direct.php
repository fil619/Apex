<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direct extends Model
{
  protected $fillable = [
     'type',
     'amount',
     'date',
     'description',

 ];
}
