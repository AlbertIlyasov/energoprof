<?

class AuthModel extends Model
{
	protected $_userId;
	protected $_exists;
	protected $_login;
	protected $_password;


	public function setLogin($login)
	{
		$this->_login = $login;
		return $this;
	}


	public function getLogin()
	{
		return $this->_login;
	}


	public function setPassword($password)
	{
		$this->_password = $password;
		return $this;
	}


	public function getPassword()
	{
		return $this->_password;
	}


	public function isExists()
	{
		return $this->_exists;
	}


	public function create()
	{
		if ($this->getLogin() && $this->getPassword()) {
			$user = DB::getRow('SELECT user_id, password FROM users WHERE login=? and active=1 LIMIT 1', 
				array($this->getLogin()));
			if ($user) {
				//if (password_verify($this->getPassword(), $user['password'])) {
				if (md5($this->getPassword()) == $user['password']) {
					$_SESSION['userId'] = $this->_userId = $user['user_id'];
					$this->_exists = true;
				}
			}
		}
		return $this;
	}


	public function check()
	{
		if ($_SESSION['userId']) {
			return true;
		}
		return false;
	}


	public function logout()
	{
		unset($_SESSION['userId']);
		return $this;
	}
}