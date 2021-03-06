<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posttest extends Model
{
    //
  protected $fillable = ['question', 'choice_1', 'choice_2', 'choice_3', 'choice_4', 'right_answer'];
  public function users(){
    return $this->belongsToMany(User::class);
  }
}
