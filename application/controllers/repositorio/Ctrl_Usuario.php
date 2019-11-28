<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_Usuario extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		//$this->load->library('excel');
		//$this->layout->setLayout('template_index');
		$this->load->model('Repositorio/Model_Login');
		$this->mssql = $this->load->database('default', TRUE );
		
    }

	public function View_Login() {
		$this->load->view('repositorio/View_Login.php');
	}

	public function Show_Brain(){
		$result = [];
		$result['status'] = 'success';
		$result['message'] = 'Yeah! You have successfully logged in.';
		$result['redirect_url'] = base_url('Ingresar');
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($result));
		$string = $this->output->get_output();
		echo $string;
		exit();		

		//$this->load->view('brain/View_Login');

	}

}
