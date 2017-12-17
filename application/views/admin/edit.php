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
<?if(empty($comment)):?>
	Элемент не найден
<?else:?>
<form method="post">
	<input type="hidden" name="referer" value="<?=$referer?>">
	<div class="form-group">
		<b>id</b>: <?=$comment['id']?>
	</div>
	<div class="form-group<?=$showErrorClass('user_name')?>">
		<label for="user_name" class="control-label">User name:</label>
		<input type="text" name="user_name" class="form-control" id="user_name" value="<?=$comment['user_name']?>">
		<span class="error-text"><?=$showErrors('user_name')?></span>
	</div>
	<div class="form-group<?=$showErrorClass('homepage')?>">
		<label for="user_name" class="control-label">Homepage:</label>
		<input type="text" name="homepage" class="form-control" id="homepage" value="<?=$comment['homepage']?>">
		<span class="error-text"><?=$showErrors('homepage')?></span>
	</div>
	<div class="form-group<?=$showErrorClass('email')?>">
		<label for="email" class="control-label">Email:</label>
		<input type="email" name="email" class="form-control" id="email" value="<?=$comment['email']?>">
		<span class="error-text"><?=$showErrors('email')?></span>
	</div>
	<div class="form-group<?=$showErrorClass('text')?>">
		<label for="text" class="control-label">Text:</label>
		<textarea name="text" class="form-control" id="text" rows = "10"><?=$comment['text']?></textarea>
		<span class="error-text"><?=$showErrors('text')?></span>
	</div>
	<input type="submit" name="submit" value="Сохранить">
	
</form>
<?endif;?>