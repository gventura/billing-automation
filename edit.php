<?php
require_once('init.php');

if (!isset($_REQUEST['do']))
{
	header('Location: index.php');
}

if ($_REQUEST['do'] == 'account_update_contactid')
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
?>