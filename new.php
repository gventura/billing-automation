<?php
require_once('init.php');

if (!isset($_REQUEST['type']))
{
	header('Location: index.php');
}
if ($_REQUEST['type'] == 'account')
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
			break;
		case 'existing':
			break;
		default:
			header('Location: index.php');
			return;
	}

	$account->create($_REQUEST['contactid'], $_REQUEST['name'], $_REQUEST['identifier']);

	if ($_REQUEST['contact'] == 'new')
	{
		header('Location: new.php?type=contact&accountid=' . $database->insert_id());
	}
	else
	{
		header('Location: manage.php?accountid=' . $database->insert_id());
	}
}
?>