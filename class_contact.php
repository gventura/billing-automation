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

	function add($fname, $lname, $email, $phone, $address1, $address2, $city, $state, $zip)
	{
		$sql = 'INSERT INTO `contact` (`fname`, `lname`, `email`, `phone`, `address1`, `address2`, `city`, `state`, `zip`) VALUES (\'' . $this->db->escape($fname) . '\', \'' . $this->db->escape($lname) . '\', \'' . $this->db->escape($email) . '\', \'' . $this->db->escape($phone) . '\', \'' . $this->db->escape($address1) . '\', ';
		(trim($address2) == '') ? $sql .= 'NULL' : $sql .= '\'' . $this->db->escape($address2) . '\'';
		$sql .= ', \'' . $this->db->escape($city) . '\', \'' . $this->db->escape($state) . '\', \'' . $this->db->escape($zip) . '\')';
		$query = $this->db->query($sql);
		$this->select($this->db->insert_id());

		return true;
	}

	function update($fname, $lname, $email, $phone, $address1, $address2, $city, $state, $zip)
	{
		$sql = 'UPDATE `contact` SET `fname` = \'' . $this->db->escape($fname) . '\', `lname` = \'' . $this->db->escape($lname) . '\', `email` = \'' . $this->db->escape($email) . '\', `phone` = \'' . $this->db->escape($phone) . '\', `address1` = \'' . $this->db->escape($address1) . '\', `address2` = ';
		(trim($address2) == '') ? $sql .= 'NULL' : $sql .= '\'' . $this->db->escape($address2) . '\'';
		$sql .= ', `city` = \'' . $this->db->escape($city) . '\', `state` = \'' . $this->db->escape($state) . '\', `zip` = \'' . $this->db->escape($zip) . '\' WHERE `contactid` = ' . $this->db->escape($this->contactid) . ' LIMIT 1';
		$query = $this->db->query($sql);
		$this->select($this->contactid);

		return true;
	}
}
?>