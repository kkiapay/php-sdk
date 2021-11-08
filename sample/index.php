<?php

namespace Kkiapay;

require '../vendor/autoload.php';

include_once('../src/Kkiapay.php');

$public_key = "xxxxxxxxxxxxxxxxxxxxxxxxxx";
$private_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxx";
$secret = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$kkiapay = new Kkiapay($public_key, $private_key, $secret);

$verify = $kkiapay->verifyTransaction("xxxxxxx");

//$refund = $kkiapay->refundTransaction("oldnbsc");

// $payout = $kkiapay->setupPayout(array( "algorithm" => "rate", "send_notification" => true, "destination_type" => "MOBILE_MONEY", "rate_frequency" => "1m", "destination" => "22997000000" ));

var_dump($verify);