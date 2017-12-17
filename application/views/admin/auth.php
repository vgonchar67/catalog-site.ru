<?php 
$showErrors = function ($key, $all = false) use (&$errors) {
	if(empty($errors[$key])) {
		return false;
	}
	if($all) {
		foreach ($errors[$key] as $value) {
			echo $value . '<br/>';
		}
	} else {
		echo $errors[$key][0];
	}
};
$showErrorClass = function ($key) use (&$errors) {
	if(!empty($errors[$key])) {
		echo 'has-class';
	}
};
?>
<form class="admin-form-auth" method="post" id="form-auth">
	<h2>Авторизируйтесь</h2>
	<div class="js-common-error"><?=$showErrors('common', true)?></div>
	<div class="form-group<?=$showErrorClass('login')?>">
		<label for="login" class="control-label">Login:</label>
		<input type="text" name="login" class="form-control" id="login" value="<?=$login?>">
		<span class="error-text"><?=$showErrors('login')?></span>
	</div>
	<div class="form-group<?=$showErrorClass('password')?>">
		<label for="password" class="control-label">Password:</label>
		<input type="password" name="password" class="form-control" id="password" value="<?=$password?>">
		<span class="error-text"><?=$showErrors('password')?></span>
	</div>
	<div class="form-group">
		<input type="submit" name="submit" class="btn btn-default pull-right" value="Войти">
	</div>
</form>