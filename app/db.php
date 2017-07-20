<?

class DB
{
	static protected $_dbh;
	static protected $_extDbh;


	static protected function _connect($dsn, $login, $passwd)
	{
		try {
			$dbh = new PDO($dsn, $login, $passwd); 
  			$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
  			return $dbh;
		} catch (PDOException $e) {
			echo 'Database error.';
			if (SITEMODE == DEBUG || Helper::isLocal()) {
				die($e->getMessage());
			}
			die;
		}
	}


	static public function setDbh()
	{
		self::$_dbh = self::_connect(DBDSN, DBLOGIN, DBPASSWD); 
		return self;
	}


	static public function getDbh()
	{
		return self::$_dbh;
	}


	static public function setExtDbh()
	{
		self::$_extDbh = self::_connect(EXT_DBDSN, EXT_DBLOGIN, EXT_DBPASSWD); 
		return self;
	}


	static public function getExtDbh()
	{
		return self::$_extDbh;
	}


	static public function getRows($sql, array $vals = array(), $fetchMode = '')
	{
		if (!$fetchMode) {
			$fetchMode = PDO::FETCH_ASSOC;
		}

		$sth = self::getDbh()->prepare($sql);
		$sth->setFetchMode($fetchMode);
		$sth->execute($vals);
		return $sth->fetchAll();
	}


	static public function getRow($sql, array $vals = array(), $fetchMode = '')
	{
		if (!$fetchMode) {
			$fetchMode = PDO::FETCH_ASSOC;
		}

		$sth = self::getDbh()->prepare($sql);
		$sth->setFetchMode($fetchMode);
		$sth->execute($vals);
		return $sth->fetch();
	}


	static public function getSimpleRows($sql, array $vals = array())
	{
		$sth = self::getDbh()->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_NUM);
		$sth->execute($vals);
		while ($row = $sth->fetch()) {
			$fields[$row[0]] = $row[1];
		}
		return $fields;
	}


	static public function getField($sql, array $vals)
	{
		$row = self::getRow($sql, $vals, PDO::FETCH_NUM);
		return $rows[0];
	}
}