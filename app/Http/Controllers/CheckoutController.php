<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    public function checkout()
    {   
       $data = Checkout::where('id','7',)->get();
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey('sk_test_51HwAEAAGBbGaxcVeGQcob5q5vgRfW12kyyrjmxiZ5obvjzLK32YGiS0WoXeBemJsYDSWSBjQABcdyojyypDANJBH00oRX2uhLL');
        		
		$amount = 6999;
		$amount *=6999;
        $amount = (int) $amount;
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => 'LKR',
			'description' => 'Payment From LeisureGuider',
			'payment_method_types' => ['card'],
		]);
		$intent = $payment_intent->client_secret;

		return view('checkout.credit-card',compact('intent'));

    }

    public function afterPayment()
    {
        echo 'Payment Has been Received';
    }
}
