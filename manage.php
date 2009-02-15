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
	$contact->select($account->contactid);
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
					<input type="hidden" name="accountid" value="<?php print($account->accountid); ?>" />
					<fieldset>
						<legend>Account <input type="submit" value="edit" /></legend>
						<div align="center">
							<?php print($account->name); ?> (<?php print($account->identifier); ?>)
						</div>
					</fieldset>
				</form>
				<form action="edit.php" method="post">
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
			</div>
		</div>
	</body>
</html>
<?php
}
?>