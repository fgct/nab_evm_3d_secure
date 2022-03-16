<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Fgc\NabEvm3dSecure\Auth;

$auth = new Auth(Auth::MODE_TEST, 'XYZ0010', 'abcd1234');
$auth->useDollar();
try {
	echo "Creating order for EVM 3D secure authentication...\n";
	$order = $auth->createOrder([
		'amount' => '10.08', // In dollar
		'currency' => 'AUD',
		'ip' => '203.89.101.20'
	]);
	var_export($order);
	/* $order = (Fgc\NabEvm3dSecure\Order) array(
		'orderId' => '3b5ce3e2-c55f-4f9d-a252-405b832d8f5d',
		'orderToken' => 'eyJjdHkiOiJKV1QiL...Yy9hObH5kn6bNQ==',
		'amount' => 10,
		'currency' => 'AUD',
		'orderType' => 'PAYMENT',
		'status' => 'NEW',
		'merchantId' => 'XYZ00',
		'merchantOrderReference' => NULL,
		'providerClientId' => 'w-188553',
		'sessionId' => 'MWJlZTM2N2ItMWQ0Ny00YWNjLThiOGYtMmRmMmUxZmUzMTAz',
		'intents' => ['THREED_SECURE']
	); */
} catch (\Exception $e) {
	echo $e->getMessage();
}

try {
	echo "\n\nProcessing transaction...\n";
	$result = $auth->processTransaction([
		'amount' => '10.08',
		'purchaseOrderNo' => 'ORDER_#0001',
		'cardNumber' => '4444333322221111',
		'cardHolderName' => 'TEST TEST',
		'expiryDate' => '10/23',
		'CAVV' => 'owbocveo5tA7DyHugsy+79oukPI=', // authenticationValue
		'SLI' => '02', // eci - E-Commerce Indicator/Security Level Indicator(SLI)
	]);
	var_export($result);
	/* $result = (Fgc\NabEvm3dSecure\Transaction) array(
	 'txnType' => '0',
   'txnSource' => '23',
   'amount' => '1000',
   'currency' => 'AUD',
   'purchaseOrderNo' => 'ORDER_#0001',
   'approved' => 'Yes',
   'responseCode' => '00',
   'responseText' => 'Approved',
   'settlementDate' => '20211030',
   'txnID' => '183917',
   'authID' => '429589',
	 ); */
} catch (\Exception $e) {
	echo $e->getMessage();
}
