$(document).ready(function(){

	$('#fchemiini').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});

	$('#fchemifin').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});

	$('#cbo_empresa').multiselect({
		buttonWidth: '100%',
		nonSelectedText: 'Seleccionar',
		onChange: function(element, checked) {
			var brands = $('#cbo_empresa option:selected');
			var selected = [];
			$(brands).each(function(index, brand){
				selected.push([$(this).val()]);
			});
	
			//console.log(selected);
			$("#hdcbo_empresa").val(selected);
		}
	});

	$('#cbo_documentos').multiselect({
		buttonWidth: '100%',
		nonSelectedText: 'Seleccionar',
		onChange: function(element, checked) {
			var brands = $('#cbo_documentos option:selected');
			var selected = [];
			$(brands).each(function(index, brand){
				selected.push([$(this).val()]);
			});
	
			//console.log(selected);
			$("#hdcbo_documentos").val(selected);
		}
	});

	/*OBTENGO FECHA CON EL TIEMPO*/
	function addZero(i) {
		if (i < 10) {
			i = '0' + i;
		}
		return i;
	}
	
	function hoyFecha(){
		var hoy = new Date();
		var dd = hoy.getDate();
		var mm = hoy.getMonth()+1;
		var yyyy = hoy.getFullYear();
		var hours = hoy.getHours();
		var minu = hoy.getMinutes();
		var secon = hoy.getSeconds();
		var milise = hoy.getMilliseconds();
		
		dd = addZero(dd);
		mm = addZero(mm);

		//return dd+'/'+mm+'/'+yyyy+'/'+hh;
		return yyyy+mm+dd+'_'+hours+minu+secon+milise;
	}

	var options = {
		url: function(phrase) {			
			return "brain/Ctrl_Operaciones_Creditos/Fn_ListarCliente";
		},	  
		getValue: function(element) {
			return element.name;
		},
		theme: "plate-dark",
		ajaxSettings: {
			dataType: "json",
			method: "POST",
			data: {
				dataType: "json"
			},
			beforeSend : function(){
				$("#txtcod_cliente").prop("readonly", true);
				$("#searchcliente").addClass("gly-spin");				
			},
			complete  : function(){
				$("#txtcod_cliente").prop("readonly", false);
				$("#searchcliente").removeClass("gly-spin");
			}
		},	  
		preparePostData: function(data) {			
			data.phrase = $("#txtcod_cliente").val();
			return data;
		},	  		
		requestDelay: 400
	};

	$("#txtcod_cliente").easyAutocomplete(options);

	$("#FormatDownload").on('click','li a',function (){
		$("#formatodescarga").text($(this).text());
		$("#extensiondwonload").text($(this).text());
	});


	$("#FormDetCu").on("submit",function(e){
		var fchemini	= $("#fchemiini").find("input").val();
		var fchemfin	= $("#fchemifin").find("input").val();
		var codcli		= $("#txtcod_cliente").val().substring(0, 11);
		var empresa		= $("#hdcbo_empresa").val();
		var documentos  = $("#hdcbo_documentos").val();
		var tabla 		= 'TMP_DETALLE_DOC_'+hoyFecha().toString();
		var formato		= $("#extensiondwonload").text();
		var session		= Math.random().toString(36).substr(2, 9);
		
		if(fchemini == "") {
			$.alert({
				icon: 'fa fa-info',
				title: 'Información',
				content: 'La "Fecha de Emision Desde" debe ser seleccionado!',
			});

			return false
		}

		if(fchemfin == "") {
			$.alert({
				icon: 'fa fa-info',
				title: 'Información',
				content: 'La "Fecha de Emision Hasta" debe ser seleccionado!',
			});

			return false
		}

		if(codcli == "") {
			$.alert({
				icon: 'fa fa-info',
				title: 'Información',
				content: 'El "Cliente" debe ser seleccionado y no estar vacio',
			});

			return false
		}	

		if(formato == "") {
			$.alert({
				icon: 'fa fa-info',
				title: 'Información',
				content: 'El "Formato" de Descarga debe ser seleccionado',
			});

			return false
		}	

		if($(this).attr("data-tipo") == "desc"){

			if(empresa == "" && documentos != ""){
				$.confirm({
					icon: 'fa fa-info',
					title: 'Confirmarción',
					content: 'La opcion "Empresa" no ha sido seleccionado, todas las alternativas de esta opcion seran considerados para la descarga, ¿desea Continuar?.',
					buttons: {
						confirmar: function () {
							AJAX_Operaciones_Creditos.Exportar_DetalleCuenta(fchemini,fchemfin,codcli,empresa,documentos,tabla,formato,session,f_success);
						},
						cancelar: function () {
							
						}
					}
				});
			}

			if(empresa != "" && documentos == ""){
				$.confirm({
					icon: 'fa fa-info',
					title: 'Confirmarción',
					content: 'La opcion "Documento" no ha sido seleccionado, todas las alternativas de esta opcion seran considerados para la descarga, ¿desea Continuar?.',
					buttons: {
						confirmar: function () {
							AJAX_Operaciones_Creditos.Exportar_DetalleCuenta(fchemini,fchemfin,codcli,empresa,documentos,tabla,formato,session,f_success);
						},
						cancelar: function () {
							
						}
					}
				});
			}

			if(empresa == "" && documentos == ""){
				$.confirm({
					icon: 'fa fa-info',
					title: 'Confirmarción',
					content: 'La opcion "Empresa" y "Documento" no han sido seleccionados, todas las alternativas de estas opciones seran considerados para la descarga, ¿desea Continuar?.',
					buttons: {
						confirmar: function () {
							AJAX_Operaciones_Creditos.Exportar_DetalleCuenta(fchemini,fchemfin,codcli,empresa,documentos,tabla,formato,session,f_success);
						},
						cancelar: function () {
							
						}
					}
				});
			}

			if(empresa != "" && documentos != ""){
				AJAX_Operaciones_Creditos.Exportar_DetalleCuenta(fchemini,fchemfin,codcli,empresa,documentos,tabla,formato,session,function(obj){

				});
			}
			
		} else if($(this).attr("data-tipo")=="cons") {
			console.log(fchemini+"---"+fchemfin+"---"+codcli+"---"+empresa);
		}

	});

	// INICIO GERENCIAL
	jQuery(".dropdown-menu li a").click(function(){
	
		jQuery(this)
			.parents('.btn-group')
			.find('.dropdown-toggle > [label]')
			.html(jQuery(this).text());
	 
	});
	// FIN GERENCIAL

	//DataTable_Operaciones_Creditos.DataTable_Documentos();

});


