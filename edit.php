<?php
require_once('init.php');

if (!isset($_REQUEST['what']) OR !isset($_REQUEST['type']))
{
	header('Location: index.php');
}

if ($_REQUEST['what'] == 'account')
{
	if ($_REQUEST['type'] == 'existing')
	{
		if (!isset($_REQUEST['accountid']) OR empty($_REQUEST['accountid']))
		{
			header('Location: index.php');
		}

		$account->select($_REQUEST['accountid']);

		if (empty($account->accountid))
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

				<form action="save.php" method="post">
					<input type="hidden" name="what" value="account" />
					<input type="hidden" name="type" value="existing" />
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
$contact->rebuild_cache();

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
								<td><a href="manage.php?what=account&type=overview&accountid=<?php print($account->accountid); ?>">Cancel</a></td>
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
}

else if ($_REQUEST['what'] == 'contact')
{
	if ($_REQUEST['type'] == 'existing')
	{
		if (!isset($_REQUEST['contactid']) OR empty($_REQUEST['contactid']))
		{
			header('Location: index.php');
		}

		$contact->select($_REQUEST['contactid']);

		if (empty($contact->contactid))
		{
			header('Location: index.php');
		}

		if (isset($_REQUEST['accountid']) AND !empty($_REQUEST['accountid']))
		{
			$account->select($_REQUEST['accountid']);
		}
?>
<html>
	<head>
		<title>Edit Contact</title>
	</head>
	<body>
		<div align="center">
			<div align="left" style="width: 500px;">
				<h1 align="center">Edit Contact</h1>
				<form action="save.php" method="post">
					<input type="hidden" name="what" value="contact" />
					<input type="hidden" name="type" value="existing" />
					<input type="hidden" name="contactid" value="<?php print($contact->contactid); ?>" />
					<input type="hidden" name="accountid" value="<?php print($account->accountid); ?>" />
					<fieldset>
						<legend>Contact Details</legend>
						<table cellpadding="2" cellspacing="0" align="center">
							<tr>
								<td align="right" valign="top">Name:</td>
								<td>
									<input type="text" name="fname" value="<?php print($contact->fname); ?>" /><br />
									<input type="text" name="lname" value="<?php print($contact->lname); ?>" />
								</td>
							</tr>
							<tr>
								<td align="right">Email:</td>
								<td><input type="text" name="email" value="<?php print($contact->email); ?>" /></td>
							</tr>
							<tr>
								<td align="right">Phone:</td>
								<td><input type="text" name="phone" value="<?php print($contact->phone); ?>" /></td>
							</tr>
							<tr>
								<td align="right" valign="top">Address:</td>
								<td>
									<input type="text" name="address1" value="<?php print($contact->address1); ?>" /><br />
									<input type="text" name="address2" value="<?php print($contact->address2); ?>" />
								</td>
							</tr>
							<tr>
								<td align="right">City:</td>
								<td><input type="text" name="city" value="<?php print($contact->city); ?>" /></td>
							</tr>
							<tr>
								<td align="right">State:</td>
								<td><input type="text" name="state" value="<?php print($contact->state); ?>" /></td>
							</tr>
							<tr>
								<td align="right">ZIP:</td>
								<td><input type="text" name="zip" value="<?php print($contact->zip); ?>" /></td>
							</tr>
							<tr>
								<td><a href="<?php empty($account->accountid) ? print('index.php') : print('manage.php?what=account&type=overview&accountid=' . $account->accountid) ; ?>">Cancel</a></td>
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
}
?>