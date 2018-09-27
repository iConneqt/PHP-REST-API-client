<?php

/**
 * This example demonstrates sending a delivery
 */

require_once dirname(__DIR__) . '/common.php';

$iconneqt = new Iconneqt\Api\Rest\Iconneqt(ICONNEQT_URL, ICONNEQT_USERNAME, ICONNEQT_PASSWORD);

$data = array(
	'newsletter'	=> 665666, //ID of the newsletter
	'list'			=> 1175, //ID of the database connected with this newsletter statistic
	'from_name'		=> 'John Doe', //Name of the sender. If not specified, the list owner will be used.
	'from_email'	=> 'example@website.com', //Email address of the sender. If not specified, the list owner will be used.
	'reply_email'	=> 'reply@website.com', //Email address for replies. If not specified, the list's reply email will be used.
	'bounce_email'	=> 'bounce@website.com' ///Email address for bounces. If not specified, the list's bounce email will be used.
);
$deliveryid = $iconneqt->putDelivery($data);

if ($deliveryid) {
	$mail = array(
		'deliveryid'	=> $deliveryid,
		'emailaddress'	=> "example@website.com", //Address of the recipient
		'sendate'		=> time(), // Date and time when to send. If none given, the email should be sent immediately
		'fields'		=>	array( // Fields that will be in the newsletter, for example if you add "%%example%%" to your newsletter, it will be replaced with "my custom field'
			array(
				'field'	=> 'example',
				'value' => 'my custom field'
			)
		),
		'attachments'	=>	array(
			array(
				'url'	 => 'https://iconneqt.nl/wp-content/uploads/2018/03/logo_iconneqt_2017_v2.svg',
				'name'	 => 'iconneqt.svg'
			)
		)
	);
	$result = $iconneqt->postDelivery($deliveryid, $mail);
	
	if ($result) {	
		echo 'Delivery sent to recipient: '.$result;
	} else {
		var_dump($result);
	}
} else {
	var_dump($deliveryid);
}


	


