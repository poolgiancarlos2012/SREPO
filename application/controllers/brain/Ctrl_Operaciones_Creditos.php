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

}
