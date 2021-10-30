<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Fgc\NabEvm3dSecure\Auth;

$auth = new Auth('sandbox', 'XYZ0010', 'abcd1234');

try {
	//code...

	$order = $auth->createOrder(['amount' => 10, 'ip' => '203.89.101.20']);
	var_dump($order);
} catch (\Exception $e) {
	echo $e->getMessage();
}

try {
	$result = $auth->processTransaction([
		'amount' => '10',
		'purchaseOrderNo' => 'ORDER_#0001',
		'cardNumber' => '4444333322221111',
		'cardHolderName' => 'TEST TEST',
		'expiryDate' => '10/23',
		'CAVV' => 'owbocveo5tA7DyHugsy+79oukPI=', // authenticationValue
		'SLI' => '02', // eci - E-Commerce Indicator/Security Level Indicator(SLI)
	]);
	var_dump($result);
} catch (\Exception $e) {
	echo $e->getMessage();
}
