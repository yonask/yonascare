<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class CompanyEmailDomain extends Model
{
    //
    public function companies() {
    	return $this->belongsTo(Company::class,'company_id');
    }
}
