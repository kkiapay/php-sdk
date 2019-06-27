<?php

namespace Kkiapay;

include_once('../src/Kkiapay.php');

$public_key = "e4e6e19080ab11e99cf7e73f32bcec42";
$private_key = "tsk_e4e708a180ab11e99cf7e73f32bcec42";
$secret = "tpk_e4e708a080ab11e99cf7e73f32bcec42";

$kkiapay = new Kkiapay($public_key, $private_key, $secret, $sandbox=true);

$revert = $kkiapay->setupPayout("roof", true, "MOBILE_MONEY","1000","22967724710","1m");

var_dump($revert);