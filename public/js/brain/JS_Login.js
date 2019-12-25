$(document).ready(function(){

    $("#loginform").on("submit",function(e){
        var vusu = $("#login-username").val();
        var vpass = $("#login-password").val();
        AJAX_Login.Validar_Acceso(vusu, vpass);
    });

    $("#btnsalir").click(function(){
        AJAX_Login.Salir();
    });

});