$(document).ready(function(){
	function setError($form, name, error) {
		var $input = $form.find('[name="'+name+'"]');
		var $formGroup = $input.closest('.form-group');
		$formGroup.addClass('has-error');
		$formGroup.find('.error-text').text(error);
	}

	$('#send').on('click', function(){
		var $form = $('#form');
		$.ajax({
			url:'/add',
			type: 'post',
			dataType: 'json',
			data: $form.find(':input').serialize()
		}).done(function(data){
			$('#captcha_image').attr('src', '/captcha');
			$('#captcha').val('');
			if(!data['result']) {
				$.each(data['errors'], function(name, errors){
					if (name === 'common') {
						$form.find('.js-common-error').text(errors[0]);
					} else {
						setError($form, name, errors[0]);
					}
				});
				return;
			}
			if (data['redirect']) {
				window.location.href = data['redirect'];
			}
			
		});

	});
});