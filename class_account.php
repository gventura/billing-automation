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

	function create($contactid, $name, $identifier)
	{
		// TODO: check if contact exists
		$query = $this->db->query('INSERT INTO `account` (`contactid`, `name`, `identifier`) VALUES (\'' . $this->db->escape($contactid) . '\', \'' . $this->db->escape($name). '\', \'' . $this->db->escape($identifier) . '\')');

		return true;
	}

	function update($contactid, $name, $identifier)
	{
		$query = $this->db->query('UPDATE `account` SET `contactid`=\'' . $this->db->escape($contactid) . '\', `name`=\'' . $this->db->escape($name) . '\', `identifier`=\'' . $this->db->escape($identifier) . '\' WHERE `accountid`=\'' . $this->db->escape($this->accountid) . '\' LIMIT 1');
	}

	function update_contact($contactid)
	{
		// TODO: check if contact exists
		return $this->db->query('UPDATE `account` SET `contactid`=' . $this->db->escape($contactid) . ' WHERE `accountid`=' . $this->accountid . ' LIMIT 1');
	}
}
?>