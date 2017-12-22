<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //

   public function companyemaildomains(){                        //company->companyemaildomains 
   	   	return $this->hasMany(CompanyEmailDomain::class);
   }

   public function admins(){

   	  return $this->hasMany(Admin::class);
   }
   
  
}
