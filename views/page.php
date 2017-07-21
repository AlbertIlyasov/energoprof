<div class="errors"><?=Helper::html_list($errors)?></div>
<div class="msg"><?=$msg?></div>

<form method="post">

<div class="form-group">
	<label for="title">Название</label>
	<input type=text name=title id=title value="<?=htmlspecialchars($model->getTitle())?>" class="form-control" required>
</div>
<div class="form-group">
	<label for="header">Краткое описание</label>
	<textarea name=header id=header required class="form-control"><?=htmlspecialchars($model->getHeader())?></textarea>
</div>
<div class="form-group">
	<label for="body">Текст</label>
	<textarea name=body id=body required class="form-control pageBody"><?=htmlspecialchars($model->getBody())?></textarea>
</div>
<div class="form-group">
	<label for="bodyExt">Дополнительно</label>
	<textarea name=bodyExt id=bodyExt class="form-control pageBody"><?=htmlspecialchars($model->getBodyExt())?></textarea>
</div>

<?=$model->isExists()
? '<button type=submit class="btn btn-success">Сохранить</button> <button type=button class="btn btn-warning" onClick="document.location.href=\''.URL.'page/delete/id='.$model->getPageId().'\'">Удалить</button>' 
: '<button type=submit class="btn btn-success">Добавить</button>'?>
</form>