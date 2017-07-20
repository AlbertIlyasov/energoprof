<?
session_start();

DEFINE('INDEX_DIR', __DIR__.'/');
require_once 'app/helper.php';
require_once 'app/settings.php';
require_once 'app/db.php';
require_once 'app/error.php';
require_once 'app/model.php';
require_once 'app/view.php';
require_once 'app/controller.php';
require_once 'models/auth.php';



$get 			= $_GET; 
$controllerName = !empty($get['controller']) ? $get['controller'] : 'main';
$action 		= !empty($get['action']) ? $get['action'] : 'index';
// unset($get['controller'], $get['action']);

$pattern = '/^[a-z0-9]+$/';
if (preg_match($pattern, $controllerName) && preg_match($pattern, $action)) {
	$controllerFile = __DIR__.'/controllers/'.$controllerName.'.php';

	if (file_exists($controllerFile)) {
		require_once $controllerFile;

		if (class_exists($controllerName)) {

			/*$modelFile = __DIR__.'/models/'.$controllerName.'.php';
			if (file_exists($modelFile)) {
				require_once $modelFile;
			}*/

			$controller = new $controllerName();
			if (method_exists($controller, $action)) {
				$controller->$action();
			} else {
				new Error(404);
			}
		} else {
			new Error(404);
		}
	} else {
		new Error(404);
	}
} else {
	new Error(404);
}
