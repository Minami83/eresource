<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pretest extends Model
{
    //
  protected $fillable = ['question', 'choice_1', 'choice_2', 'choice_3', 'choice_4'];
  public function users(){
    return $this->belongsToMany(User::class);
  }
}
