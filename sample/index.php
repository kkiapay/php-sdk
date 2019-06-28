<?php

namespace Kkiapay;

include_once('../src/Kkiapay.php');

$public_key = "xxxxxxxxxxxxxxxxxxxxxxxxxx";
$private_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxx";
$secret = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$kkiapay = new Kkiapay($public_key, $private_key, $secret, $sandbox=true);

//$verify = $kkiapay->verifyTransaction("oldnbsc");

//$refund = $kkiapay->refundTransaction("oldnbsc");

$payout = $kkiapay->setupPayout(array( "algorithm" => "rate", "send_notification" => true, "destination_type" => "MOBILE_MONEY", "rate_frequency" => "1m", "destination" => "22997000000" ));

var_dump($payout);