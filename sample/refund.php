<?php

namespace Kkiapay;

include_once('../src/Kkiapay.php');

$public_key = "12345";
$private_key = "12345";
$secret = "12345";

$kkiapay = new Kkiapay($public_key, $private_key, $secret);

$revert = $kkiapay->refundTransaction("UDQ50MPLV");

var_dump($revert);