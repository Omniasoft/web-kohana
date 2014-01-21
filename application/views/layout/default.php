<?php
	$asset
		->addStyleSheet('bootstrap')
		->addStyleSheet('bootstrap-theme')
		->addStyleSheet('layout')
		->addJavaScript('bootstrap.js')
		->addJavaScript('jquery-1.10.2');

	$menu = ['page-home', 'page-about'];
?>
<!DOCTYPE html>
<html>
<head>	
	<title><?= Request::initial()->route()->title() ?></title>
	<meta charset="utf-8">
	<?= $asset->getHtmlStyleSheet() ?> 
	<?= $asset->getHtmlJavaScript() ?> 
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Flexagon</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<?php foreach ($menu as &$entry): ?>
						<li<?= (Route::name(Request::initial()->route()) == $entry ? ' class="active"' : null) ?>><?= Nav::anchor($entry) ?></li>
					<?php endforeach; ?>
					<?php /*<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Nav header</li>
							<li><a href="#">Separated link</a></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li> */ ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<?= $content ?> 
	</div>
</body>
</html>