<?php
namespace App\Http\Controllers;

 
 use Illuminate\Http\Request;


use Softon\Indipay\Facades\Indipay;

use Gloudemans\Shoppingcart\Facades\Cart as Cart;


use Tzsk\Payu\Facade\Payment;


class PaymentController extends Controller

{

 


public function pay(){


 $data = [


 'txnid' => strtoupper(str_random(8)), # Transaction ID.


 // 'amount' => rand(100, 999), # Amount to be charged.
 'amount' => Cart::total()/100,

 'productinfo' => "Product Information",


 'firstname' => "John", # Payee Name.


 'email' => "john@gmail.com", # Payee Email Address.


 'phone' => "9876543210", # Payee Phone Number.


];

 


return Payment::make($data, function($then) {


 $then->redirectTo('payment/status/page'); # Your Status page endpoint.


});

 

}


function status(){


echo $payment = Payment::capture('sucess');

}

}

