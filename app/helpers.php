<?php 
function presentPrice($price)
    {
    	// $format = $price/100;
    	// $format = round($format);
     //    return ($format);
        // return number_format('$i', $this->price / 100);
        // return number_format($price, 2);
         return '$'.number_format($price / 100, 2);
    }
?>