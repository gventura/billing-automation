<?php
require_once('init.php');

if (!isset($_REQUEST['what']) OR !isset($_REQUEST['type']))
{
	if (isset($_REQUEST['accountid']) AND !empty($_REQUEST['accountid']))
	{
		header('Location: manage.php?what=account&type=overview&accountid=' . $_REQUEST['accountid']);
	}
	else
	{
		header('Location: index.php');
	}
}

if ($_REQUEST['what'] == 'account')
{
	if ($_REQUEST['type'] == 'overview')
	{
		$account->select($_REQUEST['accountid']);

		if (empty($account->accountid))
		{
			header('Location: index.php');
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
				<form action="manage.php" method="get">
					<input type="hidden" name="what" value="account" />
					<input type="hidden" name="type" value="overview" />
					<fieldset>
						<legend>Account [<a href="edit.php?what=account&type=existing&accountid=<?php print($account->accountid); ?>">edit</a>]</legend>
						<div align="center">
							<select name="accountid">
<?php
$account->rebuild_cache();

foreach ($account->accounts as $accountid => $name)
{
	$print = indent(8) . '<option value="' . $accountid . '"';

	if ($accountid == $account->accountid)
	{
		$print .= ' selected="selected"';
	}

	print($print . '>' . $name . '</option>' . "\n");
}
?>
							</select>
							<input type="submit" value=" View &raquo; " />
						</div>
					</fieldset>
				</form>
<?php
if (empty($account->contactid))
{
?>
				<form action="save.php" method="post">
					<input type="hidden" name="what" value="account" />
					<input type="hidden" name="type" value="update_contact" />
					<input type="hidden" name="accountid" value="<?php print($account->accountid); ?>" />
					<fieldset>
						<legend>Contact</legend>
						<table cellpadding="2" cellspacing="0" align="center">
							<tr>
								<td colspan="2"><strong>There is currently no contact assigned to this account.</strong></td>
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
$contact->rebuild_cache();

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
	$contact->select($account->contactid);

	$phone = $contact->phone;
	$phone_formatted = '(' . $phone{0} . $phone{1} . $phone{2} . ') ' . $phone{3} . $phone{4} . $phone{5} . '.' . $phone{6} . $phone{7} . $phone{8} . $phone{9};
?>
				<fieldset>
					<legend>Contact [<a href="edit.php?what=contact&type=existing&contactid=<?php print($contact->contactid); ?>&accountid=<?php print($account->accountid); ?>">edit</a>]</legend>
					<div>
						<strong><?php print($contact->fname . ' ' . $contact->lname); ?></strong><br />
						<?php print($phone_formatted); ?><br />
						<?php print($contact->email); ?><br />
						<br />
						<?php print($contact->address1); ?><br />
<?php
if (!empty($contact->address2))
{
?>
						<?php print($contact->address2); ?><br />
<?php
}
?>
						<?php print($contact->city . ', ' . $contact->state . ' ' . $contact->zip . "\n"); ?>
					</div>
				</fieldset>
<?php
}
?>
			</div>
		</div>
	</body>
</html>
<?php
	}
}
?>