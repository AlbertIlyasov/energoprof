<!DOCTYPE html>
<html lang="ru" ng-app="main">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$this->renderTitle()?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?=URL?>templates/default/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?=URL?>templates/default/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=URL?>templates/default/css/starter-template.css" rel="stylesheet">

    <!-- Свои стили -->
    <link href="<?=URL?>templates/default/css/own-styles.css" rel="stylesheet">

    <!-- Styles from MVC -->
    <link href="<?=URL?>styles/styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?=URL?>js/angular.js"></script>
    <script src="<?=URL?>js/js.js"></script>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=URL?>"><?=SITE_NAME?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?=URL?>auth">Вход</a>
            <li><a href="<?=URL?>pages">Cтраницы</a>
            <li><a href="<?=URL?>page">Добавить страницу</a>
            <li><a href="<?=URL?>logout">Выход</a>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

        <h1><?=$this->renderContentTitle()?></h1>
        <?=$out?>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=URL?>templates/default/js/1.12.4_jquery.min.js"></script>
    <script src="<?=URL?>templates/default/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=URL?>templates/default/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
