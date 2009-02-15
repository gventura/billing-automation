<?php
class account
{
	private $db;
	public $accounts;
	public $accountid;
	public $contactid;
	public $name;
	public $identifier;

	function __construct()
	{
		global $database;

		$this->db = $database;
		$this->rebuild_cache();
	}

	function rebuild_cache()
	{
		$query = $this->db->query('SELECT `accountid`, `name`, `identifier` FROM `account` ORDER BY `name` ASC');
		$accounts = array();

		while ($account = mysql_fetch_assoc($query))
		{
			$accounts[$account['accountid']] = $account['name'] . ' (' . $account['identifier'] . ')';
		}

		$this->accounts = $accounts;
	}

	function select($accountid)
	{
		$query = $this->db->query('SELECT * FROM `account` WHERE `accountid`=' . $this->db->escape($accountid) . ' LIMIT 1');
		$account = $this->db->fetch_assoc($query);
		$this->accountid = $account['accountid'];
		$this->contactid = $account['contactid'];
		$this->name = $account['name'];
		$this->identifier = $account['identifier'];
	}
}
?>