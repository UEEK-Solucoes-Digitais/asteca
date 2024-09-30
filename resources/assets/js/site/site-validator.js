window.validateInputs = function(form){

	let validate = true;

	$('.required').removeClass("red-border");
	
	form.find('input.required, textarea.required, select.required').each(function(){

		if($(this).val() == '' || $(this).val() == null) {

			$(this).addClass("red-border").focus();
            validate = false;
			return validate;
		}

	});

	return validate;

}
