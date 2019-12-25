<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
abstract class MY_Controller extends CI_Controller {
 
    function MY_Controller() {
        parent::__construct();
        $this->load->helper('url');
    }
 
    /**
	 * Archivos JS para insertar en el layout
	 * @var string
	 */
    public $js = '';

    /**
	 * Archivos CSS para insertar en el layout
	 * @var string
	 */
    public $css			= '';


    public $title       = 'Title por defecto';	
	public $keywords    = 'palabras clave';	
    public $descripcion = 'descripción seo por defecto';
    
    public function setTitle($title){
		$this->title = $title;
	}
	public function setKeywords($keywords){
		$this->keywords = $keywords;
	}
	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	public function getTitle(){
		return $this->title;
	}	
	public function getKeywords(){
		return $this->keywords;
	}
	public function getDescripcion(){
		return $this->descripcion;
	}

    public function LoadLayout($view, $params = null) {
        $data = array();
        $data['content'] = $this->load->view($view, $params, true);
        $this->load->view('layouts/layout',$data, false); 
    }

    public function LoadLayoutBrain($view, $params = null) {
        $data = array();
        $data['content'] = $this->load->view($view, $params, true);
        $this->load->view('layouts/template_brain',$data, false); 
    }

    public function Js($archivos = array()) {
		foreach ( $archivos as $archivo )
			$this->js .= "<script type=\"text/javascript\" src=\"{$archivo}\"></script>\n";
    }
    
    public function Css($archivos = array()) {
		foreach ( $archivos as $archivo )
			$this->css .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"{$archivo}\" />\n";
	}
 
}