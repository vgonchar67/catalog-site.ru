<!DOCTYPE html>
<html>
<head>
	<title>Гостевая книга</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	
	<link rel="stylesheet" href="/public/css/style.css">
	<link rel="icon" type="image/png" href="/public/favicon.png" />
</head>
<body>
<header>
	<div class="container">
		<a href="/" class="logo pull-left"><img src="/public/images/logo.png" /></a>
		<div class="header-buttons pull-right">
			<a href="/admin" class="btn btn-default">Административный раздел</a>
		</div>
	</div>
</header>
<div class="content container">

	<?= $content ?>
	
</div>
<footer >
	<div class="container">
		Гончар В.А.		
	</div>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/public/js/script.js"></script>
</body>
</html>