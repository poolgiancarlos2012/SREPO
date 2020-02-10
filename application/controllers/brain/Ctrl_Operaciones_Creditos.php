<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_Operaciones_Creditos extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('excel');
		//$this->layout->setLayout('template_index');
		$this->load->model('brain/Model_Operaciones_Creditos');
		$this->mssql = $this->load->database('default', TRUE );
    }

    public function View_Cuenta_Detalle() {
        $this->setTitle("Sistema de Reportes");
        $this->setKeywords("mas keywords");
        $this->setDescripcion("Sistema de Reportes");

		$this->Css(array(base_url()."public/css/normalize.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/bootstrap/css/bootstrap.css"));
		$this->Css(array(base_url()."public/Librerias/fontawesome-5.9.0/css/fontawesome.css"));
		$this->Css(array(base_url()."public/Librerias/fontawesome-5.9.0/css/brands.css"));
		$this->Css(array(base_url()."public/Librerias/fontawesome-5.9.0/css/solid.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/css/main.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/metismenu/metisMenu.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/onoffcanvas/onoffcanvas.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/animate.css/animate.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/css/style-switcher.css"));

		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/jquery/jquery.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/bootstrap/js/bootstrap.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/metismenu/metisMenu.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/onoffcanvas/onoffcanvas.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/screenfull/screenfull.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/js/core.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/js/app.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/js/style-switcher.js"));

		$this->Js(array(base_url()."public/Librerias/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"));
		$this->Js(array(base_url()."public/Librerias/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js"));
		$this->Css(array(base_url()."public/Librerias/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css"));

		$this->Js(array(base_url()."public/Librerias/bootstrap-multiselect/js/bootstrap-multiselect.js"));
		$this->Css(array(base_url()."public/Librerias/bootstrap-multiselect/css/bootstrap-multiselect.css"));

		// $this->Css(array(base_url()."public/Librerias/Autocomplete/jquery.autocomplete.css"));
		// $this->Js(array(base_url()."public/Librerias/Autocomplete/jquery.autocomplete.js"));

		$this->Css(array(base_url()."public/Librerias/EasyAutocomplete-1.3.5/easy-autocomplete.css"));
		$this->Css(array(base_url()."public/Librerias/EasyAutocomplete-1.3.5/easy-autocomplete.themes.css"));
		$this->Js(array(base_url()."public/Librerias/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.js"));

		$this->Css(array(base_url()."public/Librerias/jquery-confirm-v3.3.4/jquery-confirm.css"));
		$this->Js(array(base_url()."public/Librerias/jquery-confirm-v3.3.4/jquery-confirm.js"));

		$this->Css(array(base_url()."public/css/estilos.css"));
		
		$this->Js(array(base_url()."public/js/brain/JS_Login.js"));
        $this->Js(array(base_url()."public/js/brain/AJAX_Login.js"));
        
        $this->Js(array(base_url()."public/js/brain/JS_Operaciones_Creditos.js"));
        $this->Js(array(base_url()."public/js/brain/AJAX_Operaciones_Creditos.js"));
		
		$this->LoadLayoutBrain('brain/View_Cuenta_Detalle');
	}

	public function Fn_ListarCliente(){ // Consulta para usar el input txt desplegable

		if(isset($_POST['phrase'])){
			$result = $this->Model_Operaciones_Creditos->ListarCliente($_POST['phrase']);
		}

	}

	public function Fn_Exportar_DetalleCuenta() {

		$fchemini 	= $_POST['fchemini'];
		$fchemfin 	= $_POST['fchemfin'];
		$codcli 	= $_POST['codcli'];
		$empresa 	= $_POST['empresa'];
		$documentos = $_POST['documentos'];
		$tabla 		= $_POST['tabla'];
		$formato 	= $_POST['formato'];
		$session 	= $_POST['session'];
		$idusuario	= $this->session->userdata['logged_in']['idusuario'];
		$descrip	= 'HISTORICO DETALLE CUENTA';

		$RegDetCu = $this->Model_Operaciones_Creditos->Contar_Registros_DetalleCuenta($op = 2, $fchemini, $fchemfin, $codcli, $empresa, $documentos);
		$total = $RegDetCu[0]['CANT'];

		if($total > 0) {
			$this->Model_Operaciones_Creditos->Creando_Session_Descarga($descrip, $total,$idusuario,$session);

			if($formato == ".xlsx"){

				$xls = new PHPExcel();

				$columna=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ");

				$font_header = array(
					'font'  => array(
						'bold'  => true,
						'color' => array('rgb' => 'E8E8EA'),
						'size'  => 8,
						'name'  => 'Verdana'
				));
				$font_amarrillo = array(
					'font'  => array(
						'bold'  => true,
						'color' => array('rgb' => 'FFFF17'),
						'size'  => 8,
						'name'  => 'Verdana'
				));
				$font_verde = array(
					'font'  => array(
						'bold'  => true,
						'color' => array('rgb' => '92D050'),
						'size'  => 8,
						'name'  => 'Verdana'
				));
				$fondo_oscuro = array(
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => '303238')
					)
				);

				$xls->setActiveSheetIndex(0)->setTitle("HISTORICO DOCUMENTO DET.");
				$cabecera = array('COD','EMPRESA','ZONA','COD_VEN','VENDEDOR','COD_CLIENTE','CLIENTE','TD','DOCUMENTO','FECHA_EMISION','FECHA_VENCIMIENTO','MES_EMI','ANIO_EMI','DIAS_PLAZO','MON','TIPCAMV','TIPCAMC','IMPORTEDOC','CODAGE','AGENCIA','ITEM','PRODUCTO','PRESENTACION','UNID_KG/L','TOT_VOLUMEN','CODIGO','DESCRI','CANTI','PRECIO','UNID','VALORVTA','IGV','PRECIOVTA','VALORVTA_US','VALORVTA_MN','PRECIOVTA_US','PRECIOVTA_MN');
				
				$fil =1;
				$col = 0;
				foreach($cabecera as $field) {
					$xls->getActiveSheet()->setCellValueByColumnAndRow($col, $fil, $field);
					$xls->getActiveSheet()->getStyle($columna[$col].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

					$xls->getActiveSheet()->getStyle($columna[$col].$fil)->applyFromArray($fondo_oscuro);

					if($columna[$col].$fil == "AE1" || $columna[$col].$fil == "AH1" || $columna[$col].$fil == "AI1"){ # AMARILLO -> VALORVTA, VALORVTA_US, VALORVTA_MN
						$xls->getActiveSheet()->getStyle($columna[$col].$fil)->applyFromArray($font_amarrillo);
						$xls->getActiveSheet()->getStyle($columna[$col].$fil)->applyFromArray($font_amarrillo);
						$xls->getActiveSheet()->getStyle($columna[$col].$fil)->applyFromArray($font_amarrillo);

					}else if($columna[$col].$fil == "AG1" || $columna[$col].$fil == "AJ1" || $columna[$col].$fil == "AK1"){ # VERDE -> PRECIOVTA, PRECIOVTA_US, PRECIOVTA_MN
						$xls->getActiveSheet()->getStyle($columna[$col].$fil)->applyFromArray($font_verde);
						$xls->getActiveSheet()->getStyle($columna[$col].$fil)->applyFromArray($font_verde);
						$xls->getActiveSheet()->getStyle($columna[$col].$fil)->applyFromArray($font_verde);

					}else{ # NEGRO -> TODO EL RESTO
						$xls->getActiveSheet()->getStyle($columna[$col].$fil)->applyFromArray($font_header);						
					}

					$col++;
				}

				$xls->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(10);

				$xls->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(10);

				$xls->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(20);
				$xls->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(15);
				$xls->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(20);
				$xls->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(10);



				$xls->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(15);
				$xls->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(20);
				$xls->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(19);


				$xls->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(20);
				$xls->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(15);
				$xls->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(10);

				$xls->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(20);
				$xls->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(20);
				$xls->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(20);
				$xls->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(20);

				$xls->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(15);
				$xls->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(20);
				$xls->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(10);
				$xls->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(15);
				$xls->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(15);
				$xls->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(18);
				$xls->getActiveSheet()->getColumnDimensionByColumn(34)->setWidth(18);
				$xls->getActiveSheet()->getColumnDimensionByColumn(35)->setWidth(18);
				$xls->getActiveSheet()->getColumnDimensionByColumn(36)->setWidth(18);


				$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
				$objWriter->save('./documents/files/excel/'.$tabla.'.xlsx');

			}

		}

	}	

	# INICIO GERENCIAL
	public function View_Gerencial(){
		$this->setTitle("Sistema de Reportes");
        $this->setKeywords("mas keywords");
        $this->setDescripcion("Sistema de Reportes");

		$this->Css(array(base_url()."public/css/normalize.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/bootstrap/css/bootstrap.css"));
		$this->Css(array(base_url()."public/Librerias/fontawesome-5.9.0/css/fontawesome.css"));
		$this->Css(array(base_url()."public/Librerias/fontawesome-5.9.0/css/brands.css"));
		$this->Css(array(base_url()."public/Librerias/fontawesome-5.9.0/css/solid.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/css/main.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/metismenu/metisMenu.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/onoffcanvas/onoffcanvas.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/animate.css/animate.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/css/style-switcher.css"));

		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/jquery/jquery.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/bootstrap/js/bootstrap.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/metismenu/metisMenu.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/onoffcanvas/onoffcanvas.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/screenfull/screenfull.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/js/core.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/js/app.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/js/style-switcher.js"));

		$this->Js(array(base_url()."public/Librerias/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"));
		$this->Js(array(base_url()."public/Librerias/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js"));
		$this->Css(array(base_url()."public/Librerias/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css"));

		$this->Js(array(base_url()."public/Librerias/bootstrap-multiselect/js/bootstrap-multiselect.js"));
		$this->Css(array(base_url()."public/Librerias/bootstrap-multiselect/css/bootstrap-multiselect.css"));

		// $this->Css(array(base_url()."public/Librerias/Autocomplete/jquery.autocomplete.css"));
		// $this->Js(array(base_url()."public/Librerias/Autocomplete/jquery.autocomplete.js"));

		$this->Css(array(base_url()."public/Librerias/EasyAutocomplete-1.3.5/easy-autocomplete.css"));
		$this->Css(array(base_url()."public/Librerias/EasyAutocomplete-1.3.5/easy-autocomplete.themes.css"));
		$this->Js(array(base_url()."public/Librerias/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.js"));

		$this->Css(array(base_url()."public/Librerias/jquery-confirm-v3.3.4/jquery-confirm.css"));
		$this->Js(array(base_url()."public/Librerias/jquery-confirm-v3.3.4/jquery-confirm.js"));

		$this->Css(array(base_url()."public/css/estilos.css"));
		
		$this->Js(array(base_url()."public/js/brain/JS_Login.js"));
        $this->Js(array(base_url()."public/js/brain/AJAX_Login.js"));
        
        $this->Js(array(base_url()."public/js/brain/JS_Operaciones_Creditos.js"));
        $this->Js(array(base_url()."public/js/brain/AJAX_Operaciones_Creditos.js"));
		
		$this->LoadLayoutBrain('brain/View_Gerencial');

	}

	public function Fn_Listar_Documentos_Pendientes(){

		$xls = new PHPExcel();

		$columna=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ");

		$font = array(
		'font'  => array(
			'bold'  => false,
			'color' => array('rgb' => '002060'),
			'size'  => 8,
			'name'  => 'Verdana'
		));
		$font_percent = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '002060'),
			'size'  => 8,
			'name'  => 'Verdana'
		));
		$title = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '000000'),
			'size'  => 13,
			'name'  => 'Verdana'
		));
		$font_cabe_blue = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '002060'),
			'size'  => 10,
			'name'  => 'Verdana'
		));
		$font_header = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '002060'),
			'size'  => 10,
			'name'  => 'Verdana'
		));
		$font_header_amarillo = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '504500'),
			'size'  => 8,
			'name'  => 'Verdana'
		));
		$font_empresa_blue = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '1F4E78'),
			'size'  => 10,
			'name'  => 'Verdana'
		));
		$font_subtotal = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '000000'),
			'size'  => 10,
			'name'  => 'Verdana'
		));
		$border_mefium = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM
			)
		));
		$border_thin = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
			)
		);
		$border_thin_celeste = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN ,
				'color' => array('rgb' => '5094D0')
			)
			)
		);
		$border_thin_amarillo = array(
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN ,
				'color' => array('rgb' => 'CAAF00')
			)
			)
		);

		$fondo_amarillo = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'FFFF00')
			)
		);

		$fondo_celeste = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'C1EFFF')
			)
		);
		$fondo_morado_claro = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'D9E1F2')
			)
		);
		$fondo_claro = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'F0F4FF')
			)
		);
		$fondo_celeste_claro = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'DDEBF7')
			)
		);
		$fondo_celeste_oscuro = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'B8DAF7')
			)
		);

		$fondo_rojo_claro = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'FFE1E1')
			)
		);

		$fondo_verde_claro = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'D4FDCF')
			)
		);

		

		$fondo_verde = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '00FF00')
			)
		);

		$fondo_rojo = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'FF0000')
			)
		);

		$fondo_verde_petroleo = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '3E390C')
			)
		);

		$fondo_negro = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '000000')
			)
		);

		$font_futura_header = array(
		'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => '000000'),
			'size'  => 8,
			'name'  => 'Verdana'
		));

		$font_futura_texto = array(
		'font'  => array(
			'bold'  => false,
			'color' => array('rgb' => '00002B'),
			'size'  => 8,
			'name'  => 'Verdana'
		));

		$font_verdana_texto = array(
			'font'  => array(
				'bold'  => false,
				'color' => array('rgb' => '000000'),
				'size'  => 8,
				'name'  => 'Verdana'
			));

		$font_verdana_negro = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => '000000'),
				'size'  => 8,
				'name'  => 'Verdana'
			));

		$font_verdana_blanco = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),
				'size'  => 8,
				'name'  => 'Verdana'
			));

		$fondo_azul_oscuro = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '3A2060')
			)
		);

		$fondo_plomo = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'CDCFD4')
			)
		);

		$fondo_celeste_clarisimo = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'EEF3F7')
			)
		);

		function is_in_array($array, $key, $key_value){
			$within_array = 'no';
			foreach( $array as $k=>$v ){
				if( is_array($v) ){
					$within_array = is_in_array($v, $key, $key_value);
					if( $within_array == 'yes' ){
						break;
					}
				} else {
						if( $v == $key_value && $k == $key ){
								$within_array = 'yes';
								break;
						}
				}
			}
			return $within_array;
		}
		
		$xls->setActiveSheetIndex(0)->setTitle("BASE PDT");

		$cabecera = array(			
			'EMPRESA',
			'RESPONSABLE'.PHP_EOL.'DE ZONA',
			'SUPERVISOR DE RIESGOS',
			'SUPERVISOR COMERCIAL',
			'TIPO CLIENTE',
			'COD_CLIENTE',
			'CLIENTE',
			'TD',
			'NUM. DOC.',
			'FECHA'.PHP_EOL.'DOC.',
			'MES '.PHP_EOL.' EMIS',
			'AÑO '.PHP_EOL.' EMIS',
			'DIAS'.PHP_EOL.'PLAZ0',
			'FECHA'.PHP_EOL.'VCTO.',
			'MES'.PHP_EOL.'VCTO',
			'AÑO'.PHP_EOL.'VCTO',
			'DIAS TRANSC VCTO OF',
			'FECHA GERENCIAL',
			'TIPO DE OPERACIÓN',
			'RANGO VCTO',
			'IND.VCTO',
			'LINEA DE CREDITO',
			'MON',
			'IMPORTE ORIGINAL',
			'SALDO',
			'TIPO DE CAMBIO',
			'TOTAL CONVERTIDO A DOLARES',
			'TOTAL CONVERTIDO A SOLES',
			'GLOSA',
			'EST.LETR',
			//'DET_ESTADO',
			'BANCO',
			'NUM.COBRANZA',
			'VENCIMIENTO ORIGEN',
			'POSICION DE CLIENTE'
		);
				
		$fil = 1;
		$col = 0;
		foreach($cabecera as $field) {
			$xls->getActiveSheet()->setCellValueByColumnAndRow($col, $fil, $field);
			$xls->getActiveSheet()->getStyle($columna[$col].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$xls->getActiveSheet()->getStyle($columna[$col].$fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			// $xls->getActiveSheet()->getStyle($columna[$col].$fil)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$xls->getActiveSheet()->getStyle($columna[$col].$fil)->getAlignment()->setWrapText(true);

			$col++;
		}

		$xls->getActiveSheet()->getStyle('A'.$fil.':AI'.$fil)->applyFromArray($font_futura_header);
		$xls->getActiveSheet()->getRowDimension('1')->setRowHeight(40);

		$xls->getActiveSheet()->getColumnDimensionByColumn(0)->setWidth(11); // EMPRESA
		$xls->getActiveSheet()->getColumnDimensionByColumn(1)->setWidth(21); // RESPONSABLE DE ZONA
		$xls->getActiveSheet()->getColumnDimensionByColumn(2)->setWidth(15); // SUPERVISOR DE RIESGOS
		$xls->getActiveSheet()->getColumnDimensionByColumn(3)->setWidth(15); // SUPERVISOR COMERCIAL
		$xls->getActiveSheet()->getColumnDimensionByColumn(4)->setWidth(23); // TIPO CLIENTE
		$xls->getActiveSheet()->getColumnDimensionByColumn(5)->setWidth(14); // COD_CLIENTE
		$xls->getActiveSheet()->getColumnDimensionByColumn(6)->setWidth(40); // CLIENTE
		$xls->getActiveSheet()->getColumnDimensionByColumn(7)->setWidth(5);  // TD
		$xls->getActiveSheet()->getColumnDimensionByColumn(8)->setWidth(14); // NUM. DOC.
		$xls->getActiveSheet()->getColumnDimensionByColumn(9)->setWidth(14); // FECHA DOC.
		$xls->getActiveSheet()->getColumnDimensionByColumn(10)->setWidth(11); // MES EMIS
		$xls->getActiveSheet()->getColumnDimensionByColumn(11)->setWidth(10); // AÑO EMIS
		$xls->getActiveSheet()->getColumnDimensionByColumn(12)->setWidth(12); // DIAS PLAZ0
		$xls->getActiveSheet()->getColumnDimensionByColumn(13)->setWidth(13); // FECHA VCTO.
		$xls->getActiveSheet()->getColumnDimensionByColumn(14)->setWidth(10); // M_VCTO
		$xls->getActiveSheet()->getColumnDimensionByColumn(15)->setWidth(10); // AÑO VCTO
		$xls->getActiveSheet()->getColumnDimensionByColumn(16)->setWidth(14); // DIAS TRANSC VCTO OF
		$xls->getActiveSheet()->getColumnDimensionByColumn(17)->setWidth(12); // FECHA GERENCIAL
		$xls->getActiveSheet()->getColumnDimensionByColumn(18)->setWidth(17); // TIPO DE OPERACIÓN
		$xls->getActiveSheet()->getColumnDimensionByColumn(19)->setWidth(21); // RANGO VCTO
		$xls->getActiveSheet()->getColumnDimensionByColumn(20)->setWidth(14); // IND.VCTO
		$xls->getActiveSheet()->getColumnDimensionByColumn(21)->setWidth(12); // LINEA DE CREDITO
		$xls->getActiveSheet()->getColumnDimensionByColumn(22)->setWidth(5); // MON
		$xls->getActiveSheet()->getColumnDimensionByColumn(23)->setWidth(10); // IMPORTE ORIGINAL
		$xls->getActiveSheet()->getColumnDimensionByColumn(24)->setWidth(10); // SALDO
		$xls->getActiveSheet()->getColumnDimensionByColumn(25)->setWidth(9); // TIPO DE CAMBIO
		$xls->getActiveSheet()->getColumnDimensionByColumn(26)->setWidth(16); // TOTAL CONVERTIDO A DOLARES
		$xls->getActiveSheet()->getColumnDimensionByColumn(27)->setWidth(16); // TOTAL CONVERTIDO A SOLES
		$xls->getActiveSheet()->getColumnDimensionByColumn(28)->setWidth(54); // GLOSA
		$xls->getActiveSheet()->getColumnDimensionByColumn(29)->setWidth(10); // EST.LETR
		$xls->getActiveSheet()->getColumnDimensionByColumn(30)->setWidth(15); // BANCO
		$xls->getActiveSheet()->getColumnDimensionByColumn(31)->setWidth(17); // NUM.COBRANZA
		$xls->getActiveSheet()->getColumnDimensionByColumn(32)->setWidth(16); // VENCIMIENTO ORIGEN
		$xls->getActiveSheet()->getColumnDimensionByColumn(33)->setWidth(17); // POSICION DE CLIENTE

		$xls->getActiveSheet()->getStyle("R1")->applyFromArray($fondo_amarillo);



		$recorrer = $this->Model_Operaciones_Creditos->Listar_Documentos_Pendientes($_POST['modo'], $_POST['tabla']);
		// $this->Model_Operaciones_Creditos->Listar_Documentos_Pendientes($_POST['modo'], $_POST['tabla']);

		$fil=1;
		$col=0;

		foreach ($recorrer->result() as $rows) {
			$fil=$fil+1;

			$xls->getActiveSheet()->SetCellValue($columna[$col+0].$fil,  $rows->EMPRESA);
			$xls->getActiveSheet()->SetCellValue($columna[$col+1].$fil,  $rows->RESPONSABLE_ZONA);
			$xls->getActiveSheet()->SetCellValue($columna[$col+2].$fil,  $rows->SUPERVISOR);
			$xls->getActiveSheet()->SetCellValue($columna[$col+3].$fil,  $rows->SUPERVISOR_COMERCIAL);
			$xls->getActiveSheet()->SetCellValue($columna[$col+4].$fil,  $rows->TIPO_CLIENTE);
			$xls->getActiveSheet()->SetCellValue($columna[$col+5].$fil,  $rows->COD_CLIENTE);
			$xls->getActiveSheet()->SetCellValue($columna[$col+6].$fil,  $rows->CLIENTE);
			$xls->getActiveSheet()->SetCellValue($columna[$col+7].$fil,  $rows->TD);
			$xls->getActiveSheet()->SetCellValue($columna[$col+8].$fil,  $rows->DOCUMENTO);
			$xls->getActiveSheet()->SetCellValue($columna[$col+9].$fil,  $rows->FECHA_EMISION);
			$xls->getActiveSheet()->SetCellValue($columna[$col+10].$fil, $rows->MES_EMIS);
			$xls->getActiveSheet()->SetCellValue($columna[$col+11].$fil, $rows->ANIO_EMIS);
			$xls->getActiveSheet()->SetCellValue($columna[$col+12].$fil, $rows->DIAS_PLAZO);
			$xls->getActiveSheet()->SetCellValue($columna[$col+13].$fil, $rows->FECHA_VCTO);
			$xls->getActiveSheet()->SetCellValue($columna[$col+14].$fil, $rows->MES_VCTO);
			$xls->getActiveSheet()->SetCellValue($columna[$col+15].$fil, $rows->ANIO_VCTO);
			$xls->getActiveSheet()->SetCellValue($columna[$col+16].$fil, $rows->DIAS_TRANSC);
			$xls->getActiveSheet()->SetCellValue($columna[$col+17].$fil, $rows->FECHA_GERENCIAL);
			$xls->getActiveSheet()->SetCellValue($columna[$col+18].$fil, $rows->TIPO_OPERACION);
			$xls->getActiveSheet()->SetCellValue($columna[$col+19].$fil, $rows->RANGO_VCTO);
			$xls->getActiveSheet()->SetCellValue($columna[$col+20].$fil, $rows->IND_VCTO);
			$xls->getActiveSheet()->SetCellValue($columna[$col+21].$fil, $rows->LINEA_CREDITO);
			$xls->getActiveSheet()->SetCellValue($columna[$col+22].$fil, $rows->MO);
			$xls->getActiveSheet()->SetCellValue($columna[$col+23].$fil, $rows->IMPORTE); 
			$xls->getActiveSheet()->SetCellValue($columna[$col+24].$fil, $rows->SALDO); 
			$xls->getActiveSheet()->SetCellValue($columna[$col+25].$fil, $rows->TIPCAMB);
			$xls->getActiveSheet()->SetCellValue($columna[$col+26].$fil, $rows->SALDO_TOTAL_US); 
			$xls->getActiveSheet()->SetCellValue($columna[$col+27].$fil, $rows->SALDO_TOTAL_MN); 
			$xls->getActiveSheet()->SetCellValue($columna[$col+28].$fil, $rows->GLOSA);
			$xls->getActiveSheet()->SetCellValue($columna[$col+29].$fil, $rows->ESTADO);
			//$xls->getActiveSheet()->SetCellValue($columna[$col+30].$fil, $rows->DET_ESTADO);
			$xls->getActiveSheet()->SetCellValue($columna[$col+30].$fil, $rows->BANCO);
			$xls->getActiveSheet()->SetCellValue($columna[$col+31].$fil, $rows->NUM_COBRA);
			// $xls->getActiveSheet()->SetCellValue($columna[$col+32].$fil, $rows->REFERENCIA);
			$xls->getActiveSheet()->SetCellValue($columna[$col+33].$fil, $rows->POSICION_CLIENTE);

			$xls->getActiveSheet()->getStyle('A'.$fil.':AO'.$fil)->applyFromArray($font_verdana_texto);

			$xls->getActiveSheet()->getStyle($columna[$col+23].$fil)->getNumberFormat()->setFormatCode('#,##0.00');
			$xls->getActiveSheet()->getStyle($columna[$col+24].$fil)->getNumberFormat()->setFormatCode('#,##0.00');
			$xls->getActiveSheet()->getStyle($columna[$col+25].$fil)->getNumberFormat()->setFormatCode('#,##0.000');
			$xls->getActiveSheet()->getStyle($columna[$col+26].$fil)->getNumberFormat()->setFormatCode('#,##0.00');
			$xls->getActiveSheet()->getStyle($columna[$col+27].$fil)->getNumberFormat()->setFormatCode('#,##0.00');

			$xls->getActiveSheet()->getStyle($columna[$col+23].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$xls->getActiveSheet()->getStyle($columna[$col+24].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$xls->getActiveSheet()->getStyle($columna[$col+26].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$xls->getActiveSheet()->getStyle($columna[$col+27].$fil)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

			$xls->getActiveSheet()->getStyle($columna[$col+5].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$xls->getActiveSheet()->getStyle($columna[$col+7].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$xls->getActiveSheet()->getStyle($columna[$col+9].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$xls->getActiveSheet()->getStyle($columna[$col+11].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$xls->getActiveSheet()->getStyle($columna[$col+13].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$xls->getActiveSheet()->getStyle($columna[$col+15].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$xls->getActiveSheet()->getStyle($columna[$col+17].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$xls->getActiveSheet()->getStyle($columna[$col+20].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$xls->getActiveSheet()->getStyle($columna[$col+22].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$xls->getActiveSheet()->getStyle($columna[$col+33].$fil)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$xls->getActiveSheet()->getStyle('A'.$fil.':AH'.$fil)->applyFromArray($font_futura_texto);

			if($rows->RANGO_VCTO == '8-(VIGENTE)' || $rows->RANGO_VCTO == '8-(VIGENTE)'){
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($font_verdana_negro);
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($fondo_verde);
			} else if($rows->RANGO_VCTO == '9-(SALDO A FAVOR)'){
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($font_verdana_blanco);
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($fondo_verde_petroleo);
			} else if($rows->RANGO_VCTO == '1-(09 A 30 DIAS)' || $rows->RANGO_VCTO == '2-(31 A 60 DIAS)' || $rows->RANGO_VCTO == '3-(61 A 90 DIAS)' || $rows->RANGO_VCTO == '4-(91 A 120 DIAS)' || $rows->RANGO_VCTO == '5-(121 A 360 DIAS)'){
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($font_verdana_blanco);
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($fondo_rojo);
			} else if($rows->RANGO_VCTO == '0-(01 A 08 DIAS)'){
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($font_verdana_negro);
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($fondo_amarillo);
			} else if($rows->RANGO_VCTO == '6-(MAS DE 360 DIAS)' || $rows->RANGO_VCTO == '7-(COB. JUDICIAL)'){
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($font_verdana_blanco);
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($fondo_negro);
			} else if($rows->RANGO_VCTO == '7-(COB. JUDICIAL)'){
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($font_verdana_blanco);
				$xls->getActiveSheet()->getStyle($columna[$col+19].$fil)->applyFromArray($fondo_plomo);
			}

		}


		$xls->createSheet();
		$xls->setActiveSheetIndex(1)->setTitle('STATUS COLOCACIÓN');

		

		$fecha_envio=date('Y-m-d H:i:s');
		$date = new DateTime($fecha_envio);
		$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
		$objWriter->save('./documents/files/excel/GERENCIAL PENDIENTES '.$date->format('Y-m-d H.i.s').' Grupo Andina.xlsx');


	}

	# FIN GERENCIAL

	public function View_Registros_Doc_Pagos(){
		$this->setTitle("Sistema de Reportes");
        $this->setKeywords("mas keywords");
        $this->setDescripcion("Sistema de Reportes");

		$this->Css(array(base_url()."public/css/normalize.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/bootstrap/css/bootstrap.css"));
		$this->Css(array(base_url()."public/Librerias/fontawesome-5.9.0/css/fontawesome.css"));
		$this->Css(array(base_url()."public/Librerias/fontawesome-5.9.0/css/brands.css"));
		$this->Css(array(base_url()."public/Librerias/fontawesome-5.9.0/css/solid.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/css/main.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/metismenu/metisMenu.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/onoffcanvas/onoffcanvas.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/lib/animate.css/animate.css"));
		$this->Css(array(base_url()."public/Librerias/Metis/assets/css/style-switcher.css"));

		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/jquery/jquery.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/bootstrap/js/bootstrap.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/metismenu/metisMenu.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/onoffcanvas/onoffcanvas.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/lib/screenfull/screenfull.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/js/core.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/js/app.js"));
		$this->Js(array(base_url()."public/Librerias/Metis/assets/js/style-switcher.js"));

		$this->Js(array(base_url()."public/Librerias/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"));
		$this->Js(array(base_url()."public/Librerias/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js"));
		$this->Css(array(base_url()."public/Librerias/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css"));

		$this->Js(array(base_url()."public/Librerias/bootstrap-multiselect/js/bootstrap-multiselect.js"));
		$this->Css(array(base_url()."public/Librerias/bootstrap-multiselect/css/bootstrap-multiselect.css"));

		// $this->Css(array(base_url()."public/Librerias/Autocomplete/jquery.autocomplete.css"));
		// $this->Js(array(base_url()."public/Librerias/Autocomplete/jquery.autocomplete.js"));

		$this->Css(array(base_url()."public/Librerias/EasyAutocomplete-1.3.5/easy-autocomplete.css"));
		$this->Css(array(base_url()."public/Librerias/EasyAutocomplete-1.3.5/easy-autocomplete.themes.css"));
		$this->Js(array(base_url()."public/Librerias/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.js"));

		$this->Css(array(base_url()."public/Librerias/jquery-confirm-v3.3.4/jquery-confirm.css"));
		$this->Js(array(base_url()."public/Librerias/jquery-confirm-v3.3.4/jquery-confirm.js"));

		$this->Css(array(base_url()."public/css/estilos.css"));
		
		$this->Css(array(base_url()."public/Librerias/DataTable/css/dataTables.jqueryui.min.css"));
		$this->Css(array(base_url()."public/Librerias/DataTable/css/buttons.jqueryui.min.css"));

		$this->Js(array(base_url()."public/Librerias/DataTable/js/jquery.dataTables.min.js"));
		$this->Js(array(base_url()."public/Librerias/DataTable/js/dataTables.jqueryui.min.js"));
		$this->Js(array(base_url()."public/Librerias/DataTable/js/dataTables.buttons.min.js"));
		$this->Js(array(base_url()."public/Librerias/DataTable/js/buttons.jqueryui.min.js"));
		$this->Js(array(base_url()."public/Librerias/DataTable/js/buttons.html5.min.js"));
		$this->Js(array(base_url()."public/Librerias/DataTable/js/buttons.print.min.js"));
		$this->Js(array(base_url()."public/Librerias/DataTable/js/buttons.colVis.min.js"));

		$this->Js(array(base_url()."public/js/brain/JS_Login.js"));
        $this->Js(array(base_url()."public/js/brain/AJAX_Login.js"));
        
        $this->Js(array(base_url()."public/js/brain/JS_Operaciones_Creditos.js"));
        $this->Js(array(base_url()."public/js/brain/AJAX_Operaciones_Creditos.js"));
		
		$this->LoadLayoutBrain('brain/View_Registros_Doc_Pagos');

	}

}
