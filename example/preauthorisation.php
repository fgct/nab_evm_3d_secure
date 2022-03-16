<?php
require_once(__DIR__ . '/../vendor/autoload.php');

use Fgc\NabEvm3dSecure\Auth;

$auth = new Auth(Auth::MODE_TEST, 'XYZ0010', 'abcd1234');
$auth->useDollar();

try {
	echo "Processing preAuthorise...\n";
	$transaction = $auth->preAuthorise([
		'amount' => '10.08',
		'purchaseOrderNo' => 'ORDER_#0001',
		'cardNumber' => '4444333322221111',
		'cardHolderName' => 'TEST TEST',
		'expiryDate' => '10/23',
	]);
	var_export($transaction);
	/* $transaction = (Fgc\NabEvm3dSecure\Transaction) array(
		'txnType' => '10',
    'txnSource' => '23',
    'amount' => 10.08,
    'amountInCents' => '1008',
    'amountInDollar' => 10.08,
    'currency' => 'AUD',
    'purchaseOrderNo' => 'ORDER_#0001',
    'approved' => 'Yes',
    'responseCode' => '08',
    'responseText' => 'Approved',
    'settlementDate' => '20220316',
    'txnID' => '782103',
    'preauthID' => '414237',
    'authID' => '414237',
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
    'preauthID' => $transaction->preauthID,
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