<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_Operaciones_Creditos extends MY_Controller {

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
        
        $this->Js(array(base_url()."public/js/brain/JS_Operaciones_Creditos.js"));
        $this->Js(array(base_url()."public/js/brain/AJAX_Operaciones_Creditos.js"));
		
		$this->LoadLayoutBrain('brain/View_Cuenta_Detalle');
	}

}
