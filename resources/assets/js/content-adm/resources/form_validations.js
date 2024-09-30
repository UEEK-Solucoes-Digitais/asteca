window.validateInputs = function(form) {

    editors.forEach(function(item){
        item.updateSourceElement()
    })

	let validate = true;

	$('.required').css({ 'border-color': '#E8E8E8' });

	form.find('input.required, textarea.required, select.required').each(function () {

		if ($(this).val() == '' || $(this).val() == null) {

			$(this).css('border-color', '#be0007').focus();
			validate = false;
			return validate;
		}

	});

	return validate;

}

window.validateImages = function(form) {

	let validate = true;
	let text = "<p class='warning' style='color: #BE0007'>Imagem obrigatória!</p>";

	($('.warning')) ? $('.warning').remove() : '';
	$('.required').css({ 'box-shadow': 'unset' });

	form.find('input[type="file"]').each(function () {

		if ($(this).hasClass('required')) {

			if (document.getElementById($(this).attr('id')).files.length == 0) {

				$(this).css({
					'-webkit-box-shadow': 'inset 0 0 0 1px #BE0007',
					'box-shadow': 'inset 0 0 0 1px #BE0007'
				}).focus();

				$(text).appendTo($(this).parent());

				validate = false;
				return validate;

			}

		}

	});

	return validate;

}

window.validatePassword = function() {

	if($('input[name="password"]').length > 0 && $('input[name="confirm_password"]').length > 0){
		let password 	= $('input[name="password"]');
		let re_password = $('input[name="confirm_password"]');
	
		if((re_password.val() != "") && (re_password.val() !== password.val() )) {
			password.addClass("red-border").focus();
			re_password.addClass("red-border").focus();
			showModalSmallResponse("As senhas precisam ser iguais.", 'error')
			return false;
		}
	}

	return true;
}