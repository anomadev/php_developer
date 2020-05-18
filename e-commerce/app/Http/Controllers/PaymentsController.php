<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paypal;
use App\Order;
use Session;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('shopping_cart');
    }

    public function pay(Request $request)
    {
        $amount = $request->shopping_cart->amount();
        $paypal = new PayPal();
        $response = $paypal->charge($amount);

        $redirect_links = array_filter($response->result->links, function($link) {
           return $link->method == 'REDIRECT';
        });
        $redirect_links = array_values($redirect_links);

        return redirect($redirect_links[0]->href);
    }

    public function complete(Request $request)
    {
        $paypal = new Paypal();
        $response = $paypal->execute($request->paymentId, $request->PayerID);
        if($response->statusCode == 200) {
            $order = Order::createFromPayPalResponse($response->result, $request->shopping_cart);
            if($order) {
                Session::remove('shopping_cart_id');
                return view('payments.success', ['shopping_cart' => $response->shopping_cart, 'order' => $order]);
            }
        } else {
            return redirect(URL::route('shopping_cart.show'));
        }
    }
}
