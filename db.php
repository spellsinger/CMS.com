<?php

//database driver
// chto eto blyad' takoe??

class DB {
	
	var $conn;

	function __construct($config) {
		try {
			$host = $config['host'];
			$user = $config['user'];
			$password = $config['password'];
			$database = $config['database'];
		} catch (Exception $e) {
			die ("ERROR: ".$e->getMessage());
		}

		$this->conn = @mysql_connect($host, $user, $password);

		if (!$this->conn) {
			die ("Unable to init DB engine -- connection error: ".mysql_error());
		}

		//select db

		$d = @mysql_select_db($database);
		if(!$d) {
			die ("Unable to init DB engine -- Cannot select this DB");
		}
	}

	function query($query) {
		$q = @mysql_query($query, $this->conn);
		if (!$q) {
			return array(false, mysql_error());
		} else {

			return $q;
		}
	}

	function numRows($query) {

		$r = $this->query($query);
		if (!is_array($r)) {
			return mysql_num_rows($r);
		} else {
			return 0;
		}
	}

	function getAllRows($query) {
		$res = $this->query($query);
		if (!is_array($res)) {
			//we have valid mysql object
			$resultRows = array();
			while ($r = mysql_fetch_assoc($res)) {
				$resultRows[] = $r;
			}
			return $resultRows;
		} else {
			return $res;
		}
	}

}