<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use UsesUuid;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name'
  ];

 
  public function users(){
    return $this->hasMany('App\User');
  }

}
