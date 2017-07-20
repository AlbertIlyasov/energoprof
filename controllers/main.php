<?

class Main extends Controller
{
	public function index()
	{
		$this->view->set(array(
			'pageTitle' => 'title',
		))->render();

		return $this;
	}
}