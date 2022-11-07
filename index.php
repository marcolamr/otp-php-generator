<?php

require __DIR__ . '/vendor/autoload.php';

use Source\Otp;

$otp = new Otp();

echo $otp->generate();
//echo $otp->alphanumeric(6)->toUpper();
//echo $otp->alphabetic()->toLower();