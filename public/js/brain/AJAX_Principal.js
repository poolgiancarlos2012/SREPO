var AJAX_Principal = {
	url:'brain/Ctrl_Principal/',
	Salir : function(){
		$.ajax({
			url : this.url + 'Fn_Logout',
			type : 'POST',
			dataType : 'json',
			// data : {
			// 	usuario : vusu,
			// 	password : vpass
			// },
			beforeSend:function(){
				
			},
			success:function(obj){
				if(obj.status == "success"){
					window.location.href = obj.redirect_url;
				} else {
					alert(obj.message);
				}
			},
			error:function(){

			}
		});
	}
      
}