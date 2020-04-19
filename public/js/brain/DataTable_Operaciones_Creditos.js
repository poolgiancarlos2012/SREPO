var DataTable_Operaciones_Creditos = {
	DataTable_Documentos : function (){
		$tb = "#tbBaseDocumentos";

		$($tb).DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',    
            'scrollY':        "300px",
            'scrollX':        true,
            'scrollCollapse': true,
            //'paging':         false,
            "responsive": true,
            "searching": true,
            'ajax': {
                url: '../Index/ListCliente',
            },
            "language": {
                "search": "Cod.Cliente/Cliente:",
                "info": "Resultado _START_ - _END_ de _TOTAL_ Registros",
            },
            "oLanguage": {
                "sLengthMenu": "Mostrar _MENU_ Registros",
            },
            'columns': [
                    {data:'ROW_NUMBER',"title":"#", "orderable":true,"responsivePriority":1000},
                    {data:'CODIGO_CLIENTE','title':'CODIGO_CLIENTE',"orderable":true,'responsivePriority':1000},
                    {data:'CLIENTE','title':'CLIENTE',"orderable":true,'responsivePriority':1},
                    {data:'VENDEDOR','title':'VENDEDOR',"orderable":true,'responsivePriority':1003},
                    {data:'TD','title':'TD',"orderable":true,'responsivePriority':1004},
                    {data:'DOCUMENTO','title':'DOCUMENTO',"orderable":true,'responsivePriority':10005},
                    {data:'FECHA_EMI','title':'FECHA_EMI',"orderable":true,'responsivePriority':1006},
                    {data:'FECHA_VCTO','title':'FECHA_VCTO',"orderable":true,'responsivePriority':1007},
                    {data:'MON','title':'MON',"orderable":true,'responsivePriority':1008},
                    {data:'IMPORTE','title':'IMPORTE',"orderable":true,'responsivePriority':1009},
                    {data:'SALDO','title':'SALDO',"orderable":true,'responsivePriority':1010}

            ],
            "initComplete": function(settings, json) {

            },
            "fnDrawCallback": function () { // ESTE EVENTO SE EJECUTA POR CADA BOTON PAGINADOR QUE PRESIONO 
                $($tb+"_filter input").addClass("ui-widget ui-widget-content ui-corner-all"); // ESTILO PARA INPUT DEL SEARCH
                $($tb+"_wrapper th").css({'font-size':'10px'}); // TAMAÑO DE CABECERA
                $($tb+"_wrapper td").css({'font-size':'11px'}); // TAMAÑO DE CADA REGISTRO DE LA GRILLA
                $($tb+" .dataTables_wrapper .dataTables_filter,"+$tb+" .dataTables_wrapper .dataTables_length,"+$tb+" .dataTables_wrapper .dataTables_info,"+$tb+" .dataTables_wrapper .ui-button").css({
                    "font-size": "12px",
                    "padding": "0px"
                });// ESTILO A FUENTE DE TEXTO A HEADER Y FOOTER DE LA TABLA 

                $($tb+" .dataTables_wrapper .ui-toolbar").css({
                    "font-size": "12px",
                    "padding": "0px"
                }); // ESTILO A FUENTE DE TEXTO  FOOTER DE LA TABLA

                $($tb+"_wrapper .dataTables_scrollHeadInner").css({
                    'margin': '0' // EL BLOQUE DE CABECERAS LO PONE A LA IZQUIERDA
                    // 'margin': '0 auto' // EL BLOQUE DE CABECERAS LO CENTRA
                });

                $($tb+"_wrapper table.dataTable").css({
                    'margin': '0' // EL BLOQUE DE CABECERAS LO PONE A LA IZQUIERDA
                    // 'margin': '0 auto' // EL BLOQUE DE CABECERAS LO CENTRA POR DEFECTO APARECE ESTE VALOR NO DESCOMENTARLO
                });
            }
		});
		
		//var table = $($tb).DataTable();

	}
}
