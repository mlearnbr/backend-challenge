<?php 

namespace App\Service;
use Illuminate\Support\Carbon;

class UserHelper{
  
  public function formatDate($dateTime):string{
    return Carbon::parse($dateTime)->format('d/m/Y');
  }	

  function formatPhone($number):string{
    $number="(".substr($number,0,2).") ".substr($number,2,-4)." - ".substr($number,-4);
    
    return $number; 
  }

  /*function formatMsisd($number):string{
  	return preg_replace('/[^0-9]/', '', $number);
  }*/
}