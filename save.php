<?php
require_once('init.php');

if (!isset($_REQUEST['what']) OR !isset($_REQUEST['type']))
{
	header('Location: index.php');
}

if ($_REQUEST['what'] == 'account')
{
	if ($_REQUEST['type'] == 'new')
	{
		if (trim($_REQUEST['name']) == '' OR trim($_REQUEST['identifier']) == '')
		{
			header('Location: index.php');
			exit;
		}

		switch ($_REQUEST['contact'])
		{
			case 'new':
				$_REQUEST['contactid'] = 0;
				$redirect = 'new.php?type=contact&';
				break;
			case 'existing':
				$redirect = 'manage.php?';
				break;
			default:
				header('Location: index.php');
				exit;
				return;
		}

		$account->create($_REQUEST['contactid'], $_REQUEST['name'], $_REQUEST['identifier']);

		header('Location: ' . $redirect . 'accountid=' . $database->insert_id());
		exit;
	}

	if ($_REQUEST['type'] == 'existing')
	{
		if (!isset($_REQUEST['accountid']))
		{
			header('Location: index.php');
		}

		$account->select($_REQUEST['accountid']);
		$account->update($_REQUEST['contactid'], $_REQUEST['name'], $_REQUEST['identifier']);

		header('Location: manage.php?accountid=' . $account->accountid);
	}

	if ($_REQUEST['type'] == 'update_contact')
	{
		switch ($_REQUEST['contact'])
		{
			case "new":
				header('Location: new.php?type=contact&accountid=' . $_REQUEST['accountid']);
				break;
			case "existing":
				$account->select($_REQUEST['accountid']);
				$account->update_contact($_REQUEST['contactid']);
				header('Location: manage.php?accountid=' . $_REQUEST['accountid']);
				break;
			default:
				header('Location: manage.php?accountid=' . $_REQUEST['accountid']);
				return;
		}		
	}
}

if ($_REQUEST['what'] == 'contact')
{
	if ($_REQUEST['type'] == 'new')
	{
		$contact->add($_REQUEST['fname'], $_REQUEST['lname'], $_REQUEST['email'], $_REQUEST['phone'], $_REQUEST['address1'], $_REQUEST['address2'], $_REQUEST['city'], $_REQUEST['state'], $_REQUEST['zip']);

		if (isset($_REQUEST['accountid']))
		{
			$account->select($_REQUEST['accountid']);
			$account->update_contact($contact->contactid);
		}

		header('Location: manage.php?accountid=' . $account->accountid);
	}

	if ($_REQUEST['type'] == 'existing')
	{
		$contact->select($_REQUEST['contactid']);
		$contact->update($_REQUEST['fname'], $_REQUEST['lname'], $_REQUEST['email'], $_REQUEST['phone'], $_REQUEST['address1'], $_REQUEST['address2'], $_REQUEST['city'], $_REQUEST['state'], $_REQUEST['zip']);

		header('Location: manage.php?accountid=' . $_REQUEST['accountid']);
	}
}
?>