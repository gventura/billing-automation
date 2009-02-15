<?php
class database
{
	public $connection = NULL;

	function __construct($username, $password, $database, $server = 'localhost')
	{
		$this->connection = mysql_connect($server, $username, $password);

		if ($this->connection)
		{
			mysql_select_db($database);
		}
		else
		{
			die(mysql_error());
		}
	}

	function __destruct()
	{
		if ($this->connection)
		{
			mysql_close($this->connection);
		}
	}

	function escape($input)
	{
		return mysql_real_escape_string($input, $this->connection);
	}

	function query($sql)
	{
		return mysql_query($sql, $this->connection);
	}

	function fetch_assoc($query)
	{
		return mysql_fetch_assoc($query);
	}
}
?>