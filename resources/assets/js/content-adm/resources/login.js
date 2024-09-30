
$('#form-login').submit(function(e){

	e.preventDefault();

	let data = new FormData(document.getElementById("form-login"));

	$.ajax({
		type: 'POST',
		url: url_login,
		data: data,
		dataType : 'json',
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData:false,
		complete: function(retorno){

			if(retorno.responseText == 1) {

				$('.error-text').css({
					opacity: 0,
					visibility: 'hidden',
				});
				window.location = url_to_redirect;
				return;

			} else {

				$('.error-text').css({
					opacity: 1,
					visibility: 'visible',
				});
				return false;
			
			}
		}
	});

});
