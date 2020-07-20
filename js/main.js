$(document).ready(function() {

    //Si la pagina se carga arriba del todo se añade la class notScrolled
    $('.navbar').toggleClass('notScrolled', $(this).scrollTop() < $('.navbar').height());

    $("navbar-toggler").click(function() {
        if ($("#navbarSupportedContent").hasClass("show") && $("#menu").hasClass("notScrolled")) {
            $(".navbar").css("background", "#000 !important");
        } else {
            $(".navbar").css("background", "transparent !important");
        }
    });

    //Esconder menú desplegable cuando se toca alguna categoría

    var filaMenu = $(".nav-item");
    var logo = $(".navbar-brand");
    var desplegable = $("#navbarSupportedContent");

    filaMenu.click(function() {
        if (desplegable.hasClass("show")) {
            desplegable.collapse('hide');
        }
    });

    logo.click(function(){
        if (desplegable.hasClass("show")) {
            desplegable.collapse('hide');
        }
    })


    //Año automático y copyright en Footer
    var year = new Date();
    $(".cpryt").html('&copy;'+ year.getFullYear() +
    ' Webdesign Responsive | Template by <a href="https://github.com/CarlosEstebanCasado" target="_blank">Carlos Esteban</a>');

    //Función para procesar la petición del formulario
    $("#formContact").on('submit',formContact)
    function formContact(event){
        event.preventDefault();
        var data = new FormData($('#formContact').get(0));
        var wrapperMsg = $(".wrapper_msg");
        var contactForm = $("#formContact");
        var submitBtn = $("#submitBtn");
        var submitBtnDefault = submitBtn.html();


        //Petición ajax
        $.ajax({
            url: 'procesos/ajax.php',
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            beforeSend: function() {
                submitBtn.html('Sending...');
            }
        }).done(function(res){
            if (res.status === 200) {
                wrapperMsg.addClass("alert alert-success");
                wrapperMsg.html(res.msg);
                contactForm[0].reset();
                submitBtn.html(submitBtnDefault);
            } else {
                wrapperMsg.addClass("alert alert-danger");
                wrapperMsg.html(res.msg);
                submitBtn.html(submitBtnDefault);
            }
        }).always(function(){

        }).fail(function(err){
            wrapperMsg.addClass("alert alert-danger");
            wrapperMsg.html('The message could not be sent. Check it and try again');
            submitBtn.html(submitBtnDefault);
        });
    }
});
