<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
  use UsesUuid;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
