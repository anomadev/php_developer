<?php

namespace App;

use URL;
use Config;

use PayPal\Core\PayPalHttpClient;
use PayPal\v1\Payments\PaymentCreateRequest;
use PayPal\v1\Payments\PaymentExecuteRequest;
use PayPal\Core\SandboxEnvironment;

class Paypal
{
    public $client, $environment;

    public function __construct()
    {
        $clientid = Config::get('services.paypal.clientid');
        $secret = Config::get('services.paypal.secret');

        $this->environment = new SandboxEnvironment($clientid, $secret);
        $this->client = new PayPalHttpClient($this->environment);
    }

    public function buildPaymentRequest($amount)
    {
        $request = new PaymentCreateRequest();
        $body = [
            "intent" => "sale",
            "payer" => [
                "payment_method" => "paypal"
            ],
            "transactions" => [
                "amount" => [
                    "total" => $amount,
                    "currency" => "USD"
                ]
            ],

            "redirect_urls" => [
                "return_url" => URL::route('shopping_cart.show'),
                "cancel_url" => URL::route('payments.complete')
            ]
        ];

        $request->body = $body;
        return $request;
    }

    public function charge($amount)
    {
        return $this->client->execute($this->buildPaymentRequest($amount));
    }

    public function execute($paymentId, $payerId)
    {
        $paymentExecute = new PaymentExecuteRequest($paymentId);
        $paymentExecute->body = [
            "payerId" => $payerId
        ];
        return $this->client->execute($paymentExecute);
    }

}
