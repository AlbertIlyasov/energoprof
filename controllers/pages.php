<?

class Pages extends Controller
{
	public function index()
	{
		$auth = new AuthModel();
		if (!$auth->check()) {
			Helper::go('auth');
		}

		$this->view->set(array(
			'title'  => 'Страницы',
			'errors' => $errors,
		))->render();

		return $this;
	}
}
