
window.pathArray = window.location.pathname.split('/');
window.currentLocation = pathArray[2];
window.editors = [];

window.getCookie = function (cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(";");

    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];

        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }

        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
};
window.setCookie = function (cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
};

window.showAlertDialog = function (msg, showOkButton) {
    $('#infoModalText').html(msg);

    if (!showOkButton) { $('#infoModalOkBtn').hide(); }

    $("#infoModal").modal();
}

window.openModal = function (modal) {

    if (modal != "") {
        $("#" + modal).addClass("show")

        $("body, html").css({
            overflow: 'hidden',
            height: '100%',
        })
    }

}

window.closeModal = function (modal) {

    if (modal != "") {
        $("#" + modal).removeClass("show")

        $("body, html").css({
            overflow: 'auto',
            height: 'auto',
        })
    }

}

window.showModalSmallResponse = function (msg, response_type) {

    let notifications_area = $('.small-notifications-area');

    let icon;

    var notification_box = "";

    if (response_type == 'success') {

        icon = "<iconify-icon icon='akar-icons:check' class='success'></iconify-icon>";

    } else if (response_type == 'error') {

        icon = "<iconify-icon icon='clarity:times-line' class='error'></iconify-icon>";

    }

    notification_box =
        "<div class='box-small-response'>" +
        icon + "<p class='message'>" + msg + "</p>" +
        "</div>";

    notifications_area.append(notification_box);

    $('.box-small-response').each(function (i) {

        let box = $(this);

        box.css('visibility', 'visible');
        box.css('opacity', '1');

        setTimeout(function () {
            box.fadeOut(300, function () { $(this).remove(); });
        }, 5000);

    })

}

window.padNumber = function (num, size) {
    var s = num + "";
    while (s.length < size) s = "0" + s;
    return s;
}

window.clickInput = function () {

    $(".preview-img").on("click", function () {

        $(this).parents(".image-preview").find("input[type='file']").click()

    })

}

window.checkFile = function () {

    $("input[type='file']").on("change", function (e) {

        if ($(this).attr("name") != "images") {

            var files = e.target.files;
            var filename = files[0].name;
            var extension = files[0].type;

            var input = $(this);

            if (!extension.includes("image")) {
                showModalSmallResponse("Formato não suportado! Suba apenas imagens", "error")

                input.parent().find(".preview-img").css("background", "none").removeClass("w-background");

                input.val("")

            } else {

                if (files && files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {

                        input.parent().find(".preview-img").css('background-image', 'url(' + e.target.result + ')').addClass("w-background")

                    }

                    reader.readAsDataURL(files[0]);

                }
            }

        }


    })

}


$(document).on('change', ".multiple-delete", function () {

    if ($(this).prop("checked")) {

        $(".btn-multiple-actions").css("opacity", 1).css("visibility", "visible");

    } else {

        let counter = 0;

        $(".multiple-delete").each(function () {

            if ($(this).prop("checked")) {
                counter++;
            }

        });

        if (counter == 0) {
            $(".btn-multiple-actions").css("opacity", 0).css("visibility", "hidden");;
        }

    }

})

$(".btn-sync-properties").on("click", function(){
    $.ajax({
        url: syncRoute,
        type: "get",
        dataType: 'json',
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $(".btn-sync-properties").addClass('loading');
        },
        success: function (retorno) {

            if (retorno.status == 1) {
                showModalSmallResponse(retorno.msg, 'success');
                setTimeout(window.location.reload(), 4000);
            } else {
                showModalSmallResponse(retorno.msg, 'error');

            }

            $(".btn-sync-properties").removeClass('loading');
        },
        error: function (retorno) {
            showModalSmallResponse("Ocorreu um erro ao efetuar a operação. Por favor, entre em contato com o Suporte.", 'error')

            $(".btn-sync-properties").removeClass('loading');

        }
    });
})

$(".plus-item").on("click", function(){
    
    let type = $(this).data("value");

    let _class = "." + type;

    let item = $($(_class + " .default-input-group")[0]).clone();

    item.find("input").val("");

    $(_class + " .buttons").before(item);

    $(_class + " .less-item").removeAttr("hidden");

})

$(".less-item").on("click", function(){

    let type = $(this).data("value");

    let _class = "." + type;

    let inputs = $(_class + " .default-input-group");

    $(inputs[inputs.length - 1]).remove();

    inputs = $(_class + " .default-input-group");

    if(inputs.length == 1){
        $(_class + " .less-item").attr("hidden", true);
    }

})

if(currentLocation.includes('lancamento')){

    $('input[name="percentage_done"]').on('blur', function(e){
        if($(this).val() > 100){
            $(this).val(100);
        }else if($(this).val() < 0){
            $(this).val(0);
        }
    })
    
    $('#crud-map').locationpicker({
        location: {
            latitude: $('#latitude').val(),
            longitude: $('#longitude').val()
        },
        radius: 0,
        zoom: 10,
        inputBinding: {
            latitudeInput: $('#latitude'),
            longitudeInput: $('#longitude')
        },
    });
    
}


$(document).ready(function () {

    // if ($("aside.general-dashboard-aside").length > 0 && $(window).width() > 1200) {

    //     let width = $("aside.general-dashboard-aside").width() + 40;

    //     $(".content-wrap").css("padding-left", width + "px")

    // }

    $(".nav-toggle, aside .background").on("click", function () {
        $("aside.general-dashboard-aside").toggleClass("open")

        if ($("aside.general-dashboard-aside.open").length > 0) {
            $("body").addClass("fixed-position")
        } else {
            $("body").removeClass("fixed-position")
        }
    })

    $(".ckeditor-text").each(function (index) {
        let id = $(this).attr("id")

        if (id != "" && typeof id !== "undefined") {
            ClassicEditor
                .create(document.querySelector('#' + id), {
                    toolbar: {
                        // items: [ 'bold', 'italic', '|', 'undo', 'redo', '-', 'numberedList', 'bulletedList' ],
                        shouldNotGroupWhenFull: true
                    }
                })
                .then(newEditor => {
                    editors[index] = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    })

    $('#dataTable').DataTable();

    $("input[name='select-all']").on("change", function () {
        if ($(this).prop("checked")) {
            $(".multiple-delete").each(function () {
                $(this).prop("checked", true)
            })
        } else {
            $(".multiple-delete").each(function () {
                $(this).prop("checked", false)
            })
        }
    })

    $("input[name='light_mode']").on("change", function () {
        if ($(this).prop("checked")) {
            $('body').removeClass('light-mode');

            setCookie(`${cacheName}_light_mode`, 0);
        } else {
            $('body').addClass('light-mode');
            setCookie(`${cacheName}_light_mode`, 1);
        }
    })

    clickInput();
    checkFile();

})

$('#crud-map').locationpicker({
    location: {
        latitude: $('#latitude').val(),
        longitude: $('#longitude').val()
    },
    radius: 0,
    zoom: 10,
    inputBinding: {
        latitudeInput: $('#latitude'),
        longitudeInput: $('#longitude')
    },
});

import '../site/mascaras.js';
import './resources/ajax_function';
import './resources/form_validations';
import './resources/login';

