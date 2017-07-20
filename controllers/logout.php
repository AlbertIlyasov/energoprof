<?

class Logout extends Controller
{
	public function index()
	{
		$auth = new AuthModel();
		$auth->logout();
		Helper::go('auth');
	}
}
