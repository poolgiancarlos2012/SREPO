<?php
class Model_Operaciones_Creditos extends CI_Model {

	var $mssql;
    function __construct() {
		parent::__construct();
		$this->load->dbforge();
		$this->mssql = $this->load->database('default', TRUE );
		$this->load->library('session');
	}

	public function ListarCliente($filtro){

		$query = "	SELECT 
					COD_CLIENTE AS COD_CLIENTE,
					COD_CLIENTE +' - '+ CLIENTE AS NOMBRE
					FROM 
					VIEW_ALL_CLIENT_ACTIVE 
					WHERE
					RTRIM(LTRIM(COD_CLIENTE)) LIKE '%$filtro%' OR RTRIM(LTRIM(CLIENTE)) LIKE '%$filtro%'
					GROUP BY COD_CLIENTE,CLIENTE";


		$rstquery = $this->mssql->query($query);
		//echo json_encode(array('rst' => true, 'msg' => 'Se DeleteO Table '.$vtbl));

		//$rstquery->result_array();

		foreach($rstquery->result_array() as $row){
			//$json[] = $row['NOMBRE'];
			$json[] = array("name"=>$row['NOMBRE']);
		}

		echo json_encode($json);

	}

	public function Contar_Registros_DetalleCuenta($op, $fchemini, $fchemfin, $codcli, $empresa, $documentos){
		$query = " EXECUTE SP_HISTORICO_DEUDA_DETALLE_XXX ?,?,?,?,?,? ";
		$data = array(
			'op' 			=> $op, 
			'cod' 			=> $empresa, 
			'cod_cliente' 	=> $codcli, 
			'td' 			=> $documentos,
			'emini' 		=> $fchemini,
			'emifin' 		=> $fchemfin
		);
		$result = $this->mssql->query($query,$data);
		return $result->result_array();
	}

	public function Creando_Session_Descarga($descrip, $total,$idusuario,$session){

		$data = array(
			'DESCRIP'		=> $descrip,
			'EXECUTED'		=> 0,
			'TOTAL'			=> $total,
			'PERCENTAGE'	=> 0,
			'EXECUTE_TIME'	=> '',
			'DATE_ADD'		=> date('Y-m-d H:i:s'),
			'DATE_UPD'		=> date('Y-m-d H:i:s'),
			'IDUSUARIO'		=> $idusuario,
			'SESSION'		=> $session
		);

		$this->db->insert('PROGRESSBAR',$data);
	}

}
