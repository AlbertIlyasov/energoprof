<div class=errors><?=Helper::html_list($errors)?></div>

<form method="post">

<div class="form-group">
	<label for="login">Логин:</label>
	<input type=text name=login id=login value="<?=$model->getLogin()?>" required>
</div>
<div class="form-group">
	<label for="password">Пароль:</label>
	<input type=password name=password id=password value="<?=$model->getPassword()?>" required>
</div>

<button type=submit class="btn btn-success">Войти</button>
</form>
