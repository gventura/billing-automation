<?php
require_once('init.php');

if (!isset($_REQUEST['do']))
{
	header('Location: index.php');
}

if ($_REQUEST['do'] == 'contact_new')
{
	$account->select($_REQUEST['accountid']);
	$contact->add($_REQUEST['fname'], $_REQUEST['lname'], $_REQUEST['email'], $_REQUEST['phone'], $_REQUEST['address1'], $_REQUEST['address2'], $_REQUEST['city'], $_REQUEST['state'], $_REQUEST['zip']);
	$account->update_contact($contact->contactid);

	header('Location: manage.php?accountid=' . $account->accountid);
}
?>