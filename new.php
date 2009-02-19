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

if ($_REQUEST['type'] == 'contact')
{
?>
<html>
	<head>
		<title>Create a Contact</title>
	</head>
	<body>
		<div align="center">
			<div align="left" style="width: 500px;">
				<h1 align="center">Create a Contact</h1>
				<form action="save.php" method="post">
					<input type="hidden" name="do" value="contact_new" />
<?php
if (isset($_REQUEST['accountid']))
{
?>
					<input type="hidden" name="accountid" value="<?php print($_REQUEST['accountid']); ?>" />
<?php
}
?>
					<fieldset>
						<legend>Contact Details</legend>
						<table cellpadding="2" cellspacing="0" align="center">
							<tr>
								<td align="right" valign="top">Name:</td>
								<td>
									<input type="text" name="fname" /><br />
									<input type="text" name="lname" />
								</td>
							</tr>
							<tr>
								<td align="right">Email:</td>
								<td><input type="text" name="email" /></td>
							</tr>
							<tr>
								<td align="right">Phone:</td>
								<td><input type="text" name="phone" /></td>
							</tr>
							<tr>
								<td align="right" valign="top">Address:</td>
								<td>
									<input type="text" name="address1" /><br />
									<input type="text" name="address2" />
								</td>
							</tr>
							<tr>
								<td align="right">City:</td>
								<td><input type="text" name="city" /></td>
							</tr>
							<tr>
								<td align="right">State:</td>
								<td><input type="text" name="state" /></td>
							</tr>
							<tr>
								<td align="right">ZIP:</td>
								<td><input type="text" name="zip" /></td>
							</tr>
							<tr>
								<td colspan="2" align="right">
									<input type="submit" value=" Create &raquo; " />
								</td>
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
?>