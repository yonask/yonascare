<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function adminval(){

        return $this->belongsToMany(Admin::class);
    }

}
