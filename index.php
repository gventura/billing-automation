<?php
require_once('init.php');
?>
<html>
	<head>
		<title>Management Center</title>
	</head>
	<body>
		<div align="center">
			<div align="left" style="width: 500px;">
				<h1 align="center">Management Center</h1>
				<form action="manage.php" method="post">
					<input type="hidden" name="do" value="overview" />
					<fieldset>
						<legend>Manage an Account</legend>
						<div align="center">
							<select name="accountid">
<?php
foreach ($account->accounts as $accountid => $name)
{
	print(indent(8) . '<option value="' . $accountid . '">' . $name . '</option>' . "\n");
}
?>
							</select>
							<input type="submit" value=" View &raquo; " />
						</div>
					</fieldset>
				</form>
				<form action="save.php" method="post">
					<input type="hidden" name="what" value="account" />
					<input type="hidden" name="type" value="new" />
					<fieldset>
						<legend>Create an Account</legend>
						<table cellpadding="2" cellspacing="0" align="center">
							<tr>
								<td align="right">Name:</td>
								<td><input type="text" name="name" /></td>
							</tr>
							<tr>
								<td align="right">Identifier:</td>
								<td><input type="text" name="identifier" /></td>
							</tr>
							<tr>
								<td align="right" valign="top">Contact:</td>
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
	print(indent(13) . '<option value="' . $contactid . '">' . $name . '</option>' . "\n");
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