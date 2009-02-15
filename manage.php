<?php
require_once('init.php');

if (!isset($_REQUEST['accountid']))
{
	header('Location: index.php');
}

if (!isset($_REQUEST['do']))
{
	$_REQUEST['do'] = 'overview';
}

if ($_REQUEST['do'] == 'overview')
{
	$account->select($_REQUEST['accountid']);

	if ($account->accountid == '')
	{
		header('Location: index.php');
	}

	if ($account->contactid != 0)
	{
		$contact->select($account->contactid);
	}
?>
<html>
	<head>
		<title>Account Overview</title>
	</head>
	<body>
		<div align="center">
			<div align="left" style="width: 500px;">
				<h1 align="center">Account Overview</h1>
				<form action="edit.php" method="post">
					<input type="hidden" name="do" value="account_edit" />
					<input type="hidden" name="accountid" value="<?php print($account->accountid); ?>" />
					<fieldset>
						<legend>Account <input type="submit" value="edit" /></legend>
						<div align="center">
							<?php print($account->name); ?> (<?php print($account->identifier); ?>)
						</div>
					</fieldset>
				</form>
<?php
if ($account->contactid == 0)
{
?>
				<form action="edit.php" method="post">
					<input type="hidden" name="do" value="account_update_contactid" />
					<input type="hidden" name="accountid" value="<?php print($account->accountid); ?>" />
					<fieldset>
						<legend>Contact</legend>
						<table cellpadding="2" cellspacing="0" align="center">
							<tr>
								<td colspan="2">There is currently no contact assigned to this account.</td>
							</tr>
							<tr>
								<td align="right" valign="top">Options:</td>
								<td>
									<table cellpadding="2" cellspacing="0">
										<tr>
											<td colspan="2"><input type="radio" name="contact" value="new">Create New</td>
										</tr>
										<tr>
											<td><input type="radio" name="contact" value="existing">Use Existing:</td>
											<td>
												<select name="contactid">
<?php
foreach ($contact->contacts as $contactid => $name)
{
	print(increase_indent_level('<option value="' . $contactid . '">' . $name . '</option>' . "\n", 13));
}
?>
												</select>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="right">
									<input type="submit" value=" Save &raquo; " />
								</td>
							</tr>
						</table>


						</div>
					</fieldset>
				</form>
<?php
}
else
{
?>
				<form action="edit.php" method="post">
					<input type="hidden" name="do" value="contact_edit" />
					<input type="hidden" name="contactid" value="<?php print($contact->contactid); ?>" />
					<fieldset>
						<legend>Contact <input type="submit" value="edit" /></legend>
						<div align="center">
							<?php print($contact->fname . ' ' . $contact->lname); ?><br />
							<?php print($contact->email); ?><br />
							<?php print($contact->phone); ?><br />
							<?php print($contact->address1); ?><br />
<?php
if ($contact->address2 != '')
{
?>
							<?php print($contact->address2); ?><br />
<?php
}
?>
							<?php print($contact->city . ', ' . $contact->state . ' ' . $contact->zip . "\n"); ?>
						</div>
					</fieldset>
				</form>
<?php
}
?>
			</div>
		</div>
	</body>
</html>
<?php
}
?>