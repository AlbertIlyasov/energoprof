<?

class Pages extends Controller
{
	public function index()
	{
		if (!AuthModel::check()) {
			Helper::go('auth');
		}
		
		$this->view->set(array(
			'title'  => 'Страницы сайта',
		))->render();

		return $this;
	}
}
