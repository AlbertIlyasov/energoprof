<?

abstract class Controller
{
	public $view;
	public $model;
	public $date;


	public function __construct()
	{
		$this->view = new View();
		$this->view->setViewFilename(strtolower(get_called_class()));
		DB::setDbh();

		require_once(INDEX_DIR.'models/date.php');
		$this->date = new DateModel();

		$modelFile = INDEX_DIR.'models/'.strtolower(get_called_class()).'.php';
		if (file_exists($modelFile)) {
			require_once $modelFile;

			$modelName = get_called_class().'Model';
			$this->model = new $modelName();
			$this->model->date = $this->date;

			$this->view->set(array('model' => $this->model));
		}

		
		$this->view->set(array('date' => $this->date));
		$this->date->setFrom()->setTo();
	}
}