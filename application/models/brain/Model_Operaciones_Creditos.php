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

	public function Listar_Documentos_Pendientes($vmodo, $vtbl){

		$this->dbforge->add_field(array(
			'EMPRESA' => array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
			'RESPONSABLE_ZONA' => array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
			'SUPERVISOR' => array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
			'SUPERVISOR_COMERCIAL' => array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
			'TIPO_CLIENTE' => array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
			'COD_CLIENTE' => array('type' => 'VARCHAR', 'constraint' => 20, 'NULL' => TRUE),
			'CLIENTE' => array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
			'TD' => array('type' => 'VARCHAR', 'constraint' => 5, 'NULL' => TRUE),
			'DOCUMENTO' => array('type' => 'VARCHAR', 'constraint' => 20, 'NULL' => TRUE),
			'FECHA_EMISION' => array('type' => 'VARCHAR', 'constraint' => 10, 'NULL' => TRUE),
			'MES_EMIS' => array('type' => 'VARCHAR', 'constraint' => 10, 'NULL' => TRUE),
			'ANIO_EMIS' => array('type' => 'VARCHAR', 'constraint' => 100, 'NULL' => TRUE),			
			'DIAS_PLAZO' => array('type' => 'INT', 'NULL' => TRUE),
			'FECHA_VCTO' => array('type' => 'VARCHAR', 'constraint' => 10, 'NULL' => TRUE),
			'MES_VCTO' => array('type' => 'VARCHAR', 'constraint' => 10, 'NULL' => TRUE),
			'ANIO_VCTO' => array('type' => 'VARCHAR', 'constraint' => 100, 'NULL' => TRUE),
			'DIAS_TRANSC' => array('type' => 'INT', 'NULL' => TRUE),
			'FECHA_GERENCIAL' => array('type' => 'VARCHAR', 'constraint' => 10, 'NULL' => TRUE),
			'TIPO_OPERACION' => array('type' => 'VARCHAR', 'constraint' => 100, 'NULL' => TRUE),
			'RANGO_VCTO' => array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
			'IND_VCTO' => array('type' => 'VARCHAR', 'constraint' => 100, 'NULL' => TRUE),
			'LINEA_CREDITO' => array('type' => 'VARCHAR', 'constraint' => 50, 'NULL' => TRUE),
			'MO' => array('type' => 'VARCHAR', 'constraint' => 5, 'NULL' => TRUE),			
			'IMPORTE' => array('type' => 'NUMERIC', 'constraint' => '19,2', 'NULL' => TRUE),
			'SALDO' => array('type' => 'NUMERIC', 'constraint' => '19,2', 'NULL' => TRUE),
			'TIPCAMB' => array('type' => 'NUMERIC', 'constraint' => '14,6', 'NULL' => TRUE),
			'SALDO_TOTAL_US' => array('type' => 'NUMERIC', 'constraint' => '19,2', 'NULL' => TRUE),
			'SALDO_TOTAL_MN' => array('type' => 'NUMERIC', 'constraint' => '19,2', 'NULL' => TRUE),			
			'GLOSA' => array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
			'ESTADO' => array('type' => 'VARCHAR', 'constraint' => 20, 'NULL' => TRUE),
			'BANCO' => array('type' => 'VARCHAR', 'constraint' => 100, 'NULL' => TRUE),
			'NUM_COBRA' => array('type' => 'VARCHAR', 'constraint' => 100, 'NULL' => TRUE),
			//'REFERENCIA' => array('type' => 'NVARCHAR', 'constraint' => 2000, 'NULL' => TRUE),	
			'POSICION_CLIENTE' => array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
		));
		$this->dbforge->create_table($vtbl);



		// $query = " 	EXECUTE SP_GERENCIAL_XXX
		// 			?,
		// 			'0002',NULL,NULL,NULL,NULL,'0001',NULL,
		// 			'0003',NULL,NULL,NULL,NULL,'0001',NULL,
		// 			'0004',NULL,NULL,NULL,NULL,'0001',NULL,
		// 			'0016',NULL,NULL,NULL,NULL,'0000',NULL,
		// 			'0005',NULL,NULL,NULL,NULL,'0001',NULL,
		// 			'0006',NULL,NULL,NULL,NULL,'0001',NULL,
		// 			'0007',NULL,NULL,NULL,NULL,'0001',NULL,
		// 			'0017',NULL,NULL,NULL,NULL,'0000',NULL; ";

		// $data = array(
		// 	'modo' 			=> $vmodo
		// );

		// $result = $this->mssql->query($query, $data);
		// //return $result->result_array();
		// return $result;

		// $indioma_mes = "SET LANGUAGE Spanish;";
		// $this->mssql->query($indioma_mes);


		$inserttbl = "	INSERT INTO $vtbl (
						EMPRESA,
						RESPONSABLE_ZONA,
						SUPERVISOR,
						SUPERVISOR_COMERCIAL,
						TIPO_CLIENTE,
						COD_CLIENTE,
						CLIENTE,
						TD,
						DOCUMENTO,
						FECHA_EMISION,
						MES_EMIS,
						ANIO_EMIS,
						DIAS_PLAZO,
						FECHA_VCTO,
						MES_VCTO,
						ANIO_VCTO,
						DIAS_TRANSC,
						FECHA_GERENCIAL,
						TIPO_OPERACION,
						RANGO_VCTO,
						IND_VCTO,
						LINEA_CREDITO,
						MO,
						IMPORTE,
						SALDO,
						TIPCAMB,
						SALDO_TOTAL_US,
						SALDO_TOTAL_MN,
						GLOSA,
						ESTADO,
						BANCO,
						NUM_COBRA,
						POSICION_CLIENTE
						)
						SELECT * FROM OPENROWSET ('SQLOLEDB','Server=(local);TRUSTED_CONNECTION=YES;',
						'set fmtonly off EXEC [RSFACCAR].dbo.[SP_GERENCIAL_XXX]
						''$vmodo'',
						''0002'',NULL,NULL,NULL,NULL,''0001'',NULL,
						''0003'',NULL,NULL,NULL,NULL,''0001'',NULL,
						''0004'',NULL,NULL,NULL,NULL,''0001'',NULL,
						''0016'',NULL,NULL,NULL,NULL,''0000'',NULL,
						''0005'',NULL,NULL,NULL,NULL,''0001'',NULL,
						''0006'',NULL,NULL,NULL,NULL,''0001'',NULL,
						''0007'',NULL,NULL,NULL,NULL,''0001'',NULL,
						''0017'',NULL,NULL,NULL,NULL,''0000'',NULL;
						') 
						";

			$resultado = $this->mssql->query($inserttbl);

		$sqldocpend = "SELECT * FROM $vtbl";
		$result = $this->mssql->query($sqldocpend);
		return $result;

	}

}
