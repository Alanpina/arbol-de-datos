<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
	protected $fillable=['name', 'parent'];



    public function children(){
    	return $this->hasMany('App\Node', 'parent');
    }
}
