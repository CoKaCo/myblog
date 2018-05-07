<?php
/**
* http://www.php.net/manual/en/function.money-format.php
*/

namespace App;


use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
     // protected $table = 'products';
	 public function presentPrice()
    {
    	// $format = $this->price/100;
    	// $format = round($format);
     //    return ($format);
        // return money_format('$i', $this->price / 100);
        // return number_format($this->price/100, 2);
        return '$'.number_format($this->price / 100, 2);
    }
    public function scopeMightAlsoLike($query){
    	return $query->inRandomOrder()->take(8);
    }
}
