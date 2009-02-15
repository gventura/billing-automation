<?php
require_once('init.php');

if (!isset($_REQUEST['do']))
{
	header('Location: index.php');
}

if ($_REQUEST['do'] == 'account_edit')
{
	$account->select($_REQUEST['accountid']);

	if ($account->accountid == '')
	{
		header('Location: index.php');
	}
?>
<html>
	<head>
		<title>Edit Account</title>
	</head>
	<body>
		<div align="center">
			<div align="left" style="width: 500px;">
				<h1 align="center">Edit Account</h1>

				<form action="edit.php" method="post">
					<input type="hidden" name="do" value="account_update" />
					<input type="hidden" name="accountid" value="<?php print($account->accountid); ?>" />
					<fieldset>
						<legend>Information</legend>
						<table cellpadding="2" cellspacing="0" align="center">
							<tr>
								<td align="right">Name:</td>
								<td><input type="text" name="name" value="<?php print($account->name); ?>" /></td>
							</tr>
							<tr>
								<td align="right">Identifier:</td>
								<td><input type="text" name="identifier" value="<?php print($account->identifier); ?>" /></td>

							</tr>
							<tr>
								<td align="right" valign="top">Contact:</td>
								<td>
									<select name="contactid">
<?php
foreach ($contact->contacts as $contactid => $name)
{
	print(indent(10) . '<option value="' . $contactid . '"');

	if ($contactid == $account->contactid)
	{
		print(' selected="selected"');
	}

	print('>' . $name . '</option>' . "\n");
}
?>
									</select>
								</td>
							</tr>
							<tr>
								<td><input type="button" value=" Cancel " onclick="javascript:location.href='manage.php?accountid=<?php print($account->accountid); ?>';" /></td>
								<td align="right"><input type="submit" value=" Save &raquo; " /></td>
							</tr>
						</table>
					</fieldset>

				</form>
			</div>

		</div>
	</body>
</html>
<?php
}

if ($_REQUEST['do'] == 'account_update')
{
	if (!isset($_REQUEST['accountid']))
	{
		header('Location: index.php');
	}

	$account->select($_REQUEST['accountid']);
	$account->update($_REQUEST['contactid'], $_REQUEST['name'], $_REQUEST['identifier']);

	header('Location: manage.php?accountid=' . $account->accountid);
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