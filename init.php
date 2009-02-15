<?php
// Environment
error_reporting(E_ALL);
ini_set('display_errors', 'stdout');
set_magic_quotes_runtime(0);

// Includes
require_once('functions.php');
require_once('class_database.php');
require_once('class_account.php');
require_once('class_contact.php');

// Initializations
$database = new database('username', 'password', 'database');
$account = new account();
$contact = new contact();

if (isset($_REQUEST['DEBUG'])){print('<pre>');print_r($_REQUEST);print_r($database);print_r($account);print_r($contact);exit;}
?>