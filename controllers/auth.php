<?

class Auth extends Controller
{
	public function index()
	{
		if ($this->model->check()) {
			Helper::go('page');
		}
		
		$login    = Helper::post('login');
		$password = Helper::post('password');
		$errors   = array();
		
		if (is_string($login) && is_string($password)) {

			$this->model
				->setLogin($login)
				->setPassword($password);

			if ($login && $password) {
				$this->model->create();

				if ($this->model->isExists()) {
					Helper::go('page');
				} else {
					$errors['incorrect'] = 'Неверные логин или пароль';
				} 
			} else {
				if (!$login) {
					$errors['login']    = 'Укажите логин';
				}
				if (!$password) {
					$errors['password'] = 'Укажите пароль';
				}
			}
		}

		$this->view->set(array(
			'title'  => 'Авторизация',
			'errors' => $errors,
		))->render();

		return $this;
	}
}
