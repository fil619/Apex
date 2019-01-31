<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectLedger extends Model
{
  protected $fillable = [
   'ledger',
                        ];
public $timestamps = false;
}
