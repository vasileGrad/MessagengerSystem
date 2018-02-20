<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'posts';

    protected $fillable = ['user_id', 'content','status'];

    public function user(){
      return $this->belongsTo(user::class);
    }
}
