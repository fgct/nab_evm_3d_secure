<?php
require_once(__DIR__ . '/../vendor/autoload.php');

use Fgc\NabEvm3dSecure\Auth;

$auth = new Auth(Auth::MODE_TEST, 'XYZ0010', 'abcd1234');
$auth->useDollar();

try {
	echo "Processing Account Verification...\n";
	$transaction = $auth->accountVerification([
		'amount' => '10.08',
		'purchaseOrderNo' => 'ORDER_#0001',
		'cardNumber' => '4444333322221111',
		'cardHolderName' => 'TEST TEST',
		'expiryDate' => '10/23',
	]);
	var_export($transaction);
	/* $transaction = (Fgc\NabEvm3dSecure\Transaction) array(
		'txnType' => '40',
    'txnSource' => '23',
    'amount' => 0,
    'amountInCents' => '0',
    'amountInDollar' => 0,
    'currency' => 'AUD',
    'purchaseOrderNo' => 'ORDER_#0001',
    'approved' => 'Yes',
    'responseCode' => '00',
    'responseText' => 'Approved',
    'settlementDate' => '20220316',
    'txnID' => '782197',
    'preauthID' => NULL,
    'authID' => '724992',
	); */
} catch (\Exception $e) {
	echo $e->getMessage();
}
