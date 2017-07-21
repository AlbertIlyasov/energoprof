<?

class Page extends Controller
{
	public function index()
	{
		if (!AuthModel::check()) {
			Helper::go('auth');
		}
		$pageId = Helper::get('id');
		$errors = array();
		$msg    = Helper::get('msg') == 'saved' ? 'Страница успешно сохранена.' : '';

		if ($pageId) {
			$this->model->load($pageId);

			if (!$this->model->isExists()) {
				$this->view->set(array(
					'title'  => 'Страница не существует',
				))->render();
				return;
			}
		} 

		if (!empty($_POST)) {
			$this->model->set($_POST);

			if (!$this->model->getTitle()) {
				$errors['title']  = 'Заполните поле "Название"';
			}
			if (!$this->model->getHeader()) {
				$errors['header'] = 'Заполните поле "Краткое описание"';
			}
			if (!$this->model->getBody()) {
				$errors['body']   = 'Заполните поле "Текст"';
			}

			if (empty($errors)) {
				$this->model->save();
				if ($this->model->getPageId()) {
					//Страница успешно сохранена
					Helper::go('page/index/msg=saved&id='.$this->model->getPageId());
				} else {
					$errors['save'] = 'Не удалось сохранить.';
				}
			}
		}
		

		$this->view->set(array(
			'title'  => $this->model->isExists() ? 'Редактирование страницы' : 'Новая страница',
			'errors'  => $errors,
			'msg'  => $msg,
		))->render();

		return $this;
	}


	public function delete()
	{
		$pageId = Helper::get('id');
		$errors = array();

		$this->view->setNoViewFilename();
		if ($pageId) {
			$this->model->load($pageId);

			if ($this->model->isExists()) {
				$this->model->delete();

				$this->view->set(array(
					'title'=> 'Удаление страницы',
					'out'  => 'Страница удалена.'
				))->render();
				return;
			}
		} 
		

		$this->view->set(array(
			'title'=> 'Страница не существует',
		))->render();

		return $this;
	}
}
