<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_Usuario extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('brain/Model_Ingresar');			
		$this->mssql = $this->load->database('default', TRUE );		
    }

	public function View_Login() {
		$this->load->view('brain/View_Login');
	}



	public function Fn_Validar_Acceso(){

        $user = $_POST['usuario'];
        $pass = $_POST['password'];

        $Validar = $this->Model_Ingresar->Validar_Acceso($user, $pass);   

		$result = [];

		if($Validar) {
            $data_user = $this->Model_Ingresar->Obtener_Informacion($user, $pass);

            $session_data = array(
                'nombre' => $data_user[0]['NOMBRE'],
                'paterno' => $data_user[0]['PATERNO'],
                'materno' => $data_user[0]['MATERNO'],
                'usuario' => $data_user[0]['USUARIO'],
                'tipo_usuario' => $data_user[0]['TIPO_USUARIO']
            );



            $this->session->set_userdata('logged_in', $session_data);

			$result['status'] = 'success';
			$result['message'] = 'Yeah! You have successfully logged in.';
			$result['redirect_url'] = base_url('Principal');
		} else {
			$result['status'] = 'error';
            $result['message'] = 'Whoops! Incorrect User & Password. Please try again';
            $result['redirect_url'] = base_url('Ingresar');
		}
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($result));
		$string = $this->output->get_output();
		echo $string;
		exit();
    }
    
    public function Fn_Logout() {       
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        
        $result['status'] = 'success';
        $result['message'] = 'Successfully Logout';
        $result['redirect_url'] = base_url('Ingresar');

        $this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($result));
		$string = $this->output->get_output();
		echo $string;
		exit();
    }

}
?>