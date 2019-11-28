$(document).ready(function(){
    $("body").bind("tripleclick", function() {
        //window.location = 'http://191.98.186.82:8080/SREPO/brain/Ctrl_Usuario';
		//window.location = 'http://191.98.186.82:8080/SREPO/Ingresar';
		//window.location = $("#urlbase").val()+'Ingresar';
		
		AJAX_Login.Show_Brain();
		//alert("<?php echo 'asd' ?>"); 

    });
});
