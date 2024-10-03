
var redirectToList = function() {
    window.location.reload();
}

$('form#send-contact').on("submit", function(e){
    let form = $(this);
    e.preventDefault();
    if(validateInputs(form)){
        $('button[type="submit"]').addClass('disabled');
        ajaxSubmit("send-contact", url);
    }
});

function ajaxSubmit(id, route){
    var data = new FormData(document.getElementById(id));

    $.ajax({
        url: route,
        type: "POST",
        data: data,
        mimeType: "multipart/form-data",
        dataType : 'json',
        contentType: false,
        cache: false,
        processData:false,
        success     : function(retorno){

            $('button[type="submit"]').removeClass('disabled');
            $("#result-modal .geral-title").html(retorno.title)
            $("#result-modal .geral-text").html(retorno.msg)
            openModal("result-modal")

            if(retorno.status == 1){
                setTimeout(()=>{redirectToList()}, 4000);
            }
        },
        error     : function(retorno){
            $('button[type="submit"]').removeClass('disabled');
            
            $("#result-modal .geral-title").html("Ocorreu um erro ao efetuar a operação")
            $("#result-modal .geral-text").html("Por favor, entre em contato com o Suporte.")
            openModal("result-modal")
        }
    });
}