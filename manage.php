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
					<input type="hidden" name="what" value="account" />
					<input type="hidden" name="accountid" value="<?php print($account->accountid); ?>" />
					<fieldset>
						<legend>Account <input type="submit" value="edit" /></legend>
						<div align="center">
							<strong><?php print($account->name); ?></strong> (<?php print($account->identifier); ?>)
						</div>
					</fieldset>
				</form>
<?php
if ($account->contactid == 0)
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
	$phone = $contact->phone;
	$contact->phone = '(' . $phone{0} . $phone{1} . $phone{2} . ') ' . $phone{3} . $phone{4} . $phone{5} . '.' . $phone{6} . $phone{7} . $phone{8} . $phone{9};
	$mapquery = $contact->address1 . ', ';
	($contact->address2 == '') ? false : $mapquery .= $contact->address2 . ', ' ;
	$mapquery .= $contact->city . ', ' . $contact->state . ' ' . $contact->zip;
?>
				<form action="edit.php" method="post">
					<input type="hidden" name="what" value="contact" />
					<input type="hidden" name="contactid" value="<?php print($contact->contactid); ?>" />
					<input type="hidden" name="accountid" value="<?php print($account->accountid); ?>" />
					<fieldset>
						<legend>Contact <input type="submit" value="edit" /></legend>
						<div>
							<strong><?php print($contact->fname . ' ' . $contact->lname); ?></strong><br />
							<a href="http://www.whitepages.com/search/ReversePhone?full_phone=<?php print($contact->phone); ?>" target="_blank" title="Reverse Lookup"><?php print($contact->phone); ?></a><br />
							<a href="mailto:<?php print($contact->email); ?>"><?php print($contact->email); ?></a><br />
							<br />
							<a href="http://maps.google.com/?q=<?php print($mapquery); ?>" target="_blank" title="View Map">
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
							</a>
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