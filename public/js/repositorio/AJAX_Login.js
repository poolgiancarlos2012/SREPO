var AJAX_Login = {
	url:'repositorio/Ctrl_Usuario/',
    Show_Brain : function(){
		$.ajax({
			//url : this.url + 'Show_Brain',
			url : window.location + this.url + 'Show_Brain',
			type : 'POST',
			dataType : 'json',
			data : {
				// usuario : vusu,
				// password : vpass
			},
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
