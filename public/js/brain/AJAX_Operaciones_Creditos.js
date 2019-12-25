var AJAX_Operaciones_Creditos = {
	Exportar_DetalleCuenta : function(fchemini,fchemfin,codcli,empresa,documentos,tabla,formato,session,f_success){
		$.ajax({
			url		: 'brain/Ctrl_Operaciones_Creditos/Fn_Exportar_DetalleCuenta',
			type	: 'POST',
			dataType: 'json',
			data	: {
				fchemini 	: fchemini,
				fchemfin 	: fchemfin,
				codcli 		: codcli,
				empresa 	: empresa,
				documentos 	: documentos,
				tabla 		: tabla,
				formato 	: formato,
				session		: session
			},
			beforeSend : function() {
				
			},
			success : function(obj) {
				f_success(obj);
			},
			error : function() {

			}
		});
		
	}
	
}
