<?php
class contact
{
	private $db;
	public $contacts;
	public $contactid;
	public $fname;
	public $lname;
	public $email;
	public $phone;
	public $address1;
	public $address2;
	public $city;
	public $state;
	public $zip;

	function __construct()
	{
		global $database;

		$this->db = $database;
		$this->rebuild_cache();
	}

	function rebuild_cache()
	{
		$query = $this->db->query('SELECT `contactid`, `lname`, `fname` FROM `contact` ORDER BY `lname`, `fname` ASC');
		$contacts = array();

		while ($contact = mysql_fetch_assoc($query))
		{
			$contacts[$contact['contactid']] = $contact['lname'] . ', ' . $contact['fname'];
		}

		$this->contacts = $contacts;
	}

	function select($contactid)
	{
		$query = $this->db->query('SELECT * FROM `contact` WHERE `contactid`=' . $this->db->escape($contactid) . ' LIMIT 1');
		$contact = $this->db->fetch_assoc($query);
		$this->contactid = $contact['contactid'];
		$this->fname = $contact['fname'];
		$this->lname = $contact['lname'];
		$this->email = $contact['email'];
		$this->phone = $contact['phone'];
		$this->address1 = $contact['address1'];
		$this->address2 = $contact['address2'];
		$this->city = $contact['city'];
		$this->state = $contact['state'];
		$this->zip = $contact['zip'];
	}
}
?>