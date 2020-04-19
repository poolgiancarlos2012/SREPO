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
			'DET_ESTADO' => array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
			'BANCO' => array('type' => 'VARCHAR', 'constraint' => 100, 'NULL' => TRUE),
			'NUM_COBRA' => array('type' => 'VARCHAR', 'constraint' => 100, 'NULL' => TRUE),
			//'REFERENCIA' => array('type' => 'NVARCHAR', 'constraint' => 2000, 'NULL' => TRUE),	
			'POSICION_CLIENTE' => array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
		));
		$this->dbforge->create_table($vtbl);

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
						DET_ESTADO,
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

	public function Listar_Status_Colocacion($tabla,$status){
		$this->dbforge->add_field(array(
			'A_CARTERA_TOTAL' 		=> array('type' => 'VARCHAR', 'constraint' => 255, 'NULL' => TRUE),
			'A_CARTERA_VIGENTE' 	=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'A_COBRA_JUDI' 			=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'A_CARTERA_1_A_8' 		=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'A_CARTERA_9_A_30' 		=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'A_CARTERA_31_A_60' 	=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'A_CARTERA_61_A_90' 	=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'A_CARTERA_91_A_120' 	=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'A_CARTERA_121_A_360' 	=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'A_CARTERA_MAS_360' 	=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),

			'B_CARTERA_MORA_1' 		=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'B_COBRA_JUDI' 			=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'B_CARTERA_VIGENTE' 	=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'B_CARTERA_TOTAL' 		=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),

			'C_CARTERA_MORA_1' 		=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'C_COBRA_JUDI' 			=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'C_CARTERA_VIGENTE' 	=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),

			'D_CARTERA_MORA_9' 		=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'D_COBRA_JUDI' 			=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'D_CARTERA_VIGENTE_1_8' => array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'D_CARTERA_TOTAL' 		=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),

			'E_CARTERA_MORA_9' 		=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'E_COBRA_JUDI' 			=> array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0),
			'E_CARTERA_VIGENTE_1_8' => array('type' => 'NUMERIC', 'constraint' => '19,2','default' => 0)
		));
		$this->dbforge->create_table($status);

		$update = "	INSERT INTO $status (
						A_CARTERA_TOTAL,
						A_CARTERA_VIGENTE,
						A_COBRA_JUDI,
						A_CARTERA_1_A_8,
						A_CARTERA_9_A_30,
						A_CARTERA_31_A_60,
						A_CARTERA_61_A_90,
						A_CARTERA_91_A_120,
						A_CARTERA_121_A_360,
						A_CARTERA_MAS_360
					)
					SELECT 
						RESPONSABLE_ZONA					AS 'A_CARTERA_TOTAL',
						ISNULL([8-(VIGENTE)],0)				AS 'A_CARTERA_VIGENTE',
						ISNULL([7-(COB. JUDICIAL)],0)		AS 'A_COBRA_JUDI',
						ISNULL([0-(01 A 08 DIAS)],0)		AS 'A_CARTERA_1_A_8',	
						ISNULL([1-(09 A 30 DIAS)] ,0)		AS 'A_CARTERA_9_A_30',	
						ISNULL([2-(31 A 60 DIAS)] ,0)		AS 'A_CARTERA_31_A_60',	
						ISNULL([3-(61 A 90 DIAS)] ,0)		AS 'A_CARTERA_61_A_90',	
						ISNULL([4-(91 A 120 DIAS)] ,0)		AS 'A_CARTERA_91_A_120',	
						ISNULL([5-(121 A 360 DIAS)] ,0)		AS 'A_CARTERA_121_A_360',	
						ISNULL([6-(MAS DE 360 DIAS)] ,0)	AS 'A_CARTERA_MAS_360'
					FROM (SELECT RESPONSABLE_ZONA,RANGO_VCTO,SALDO_TOTAL_US FROM $tabla) AS TMP
					PIVOT(SUM(SALDO_TOTAL_US) FOR RANGO_VCTO IN ([8-(VIGENTE)],[7-(COB. JUDICIAL)],[0-(01 A 08 DIAS)],	[1-(09 A 30 DIAS)],	[2-(31 A 60 DIAS)],	[3-(61 A 90 DIAS)],	[4-(91 A 120 DIAS)],	[5-(121 A 360 DIAS)],	[6-(MAS DE 360 DIAS)]) ) AS PVTTABLE";

		if($this->mssql->query($update)){

			$update_B = "	UPDATE $status 
							SET 
							B_CARTERA_MORA_1 = A_CARTERA_1_A_8 + A_CARTERA_9_A_30 + A_CARTERA_31_A_60 + A_CARTERA_61_A_90 + A_CARTERA_91_A_120 + A_CARTERA_121_A_360 + A_CARTERA_MAS_360,
							B_COBRA_JUDI = A_COBRA_JUDI,
							B_CARTERA_VIGENTE = A_CARTERA_VIGENTE,
							B_CARTERA_TOTAL = A_CARTERA_VIGENTE + A_COBRA_JUDI +A_CARTERA_1_A_8 + A_CARTERA_9_A_30 + A_CARTERA_31_A_60 + A_CARTERA_61_A_90 + A_CARTERA_91_A_120 + A_CARTERA_121_A_360 + A_CARTERA_MAS_360";

			if($this->mssql->query($update_B)){
				$update_C = "	UPDATE $status 
								SET	
								C_CARTERA_MORA_1 = B_CARTERA_MORA_1/B_CARTERA_TOTAL,
								C_COBRA_JUDI = B_COBRA_JUDI/B_CARTERA_TOTAL,
								C_CARTERA_VIGENTE = B_CARTERA_VIGENTE/B_CARTERA_TOTAL";
				
				if($this->mssql->query($update_C)){
					$update_D = "	UPDATE $status 
									SET
									D_CARTERA_MORA_9 = A_CARTERA_9_A_30 + A_CARTERA_31_A_60 + A_CARTERA_61_A_90 + A_CARTERA_91_A_120 + A_CARTERA_121_A_360 + A_CARTERA_MAS_360,
									D_COBRA_JUDI = A_COBRA_JUDI,
									D_CARTERA_VIGENTE_1_8 = A_CARTERA_VIGENTE + A_COBRA_JUDI,
									D_CARTERA_TOTAL = B_CARTERA_TOTAL
									";
						if($this->mssql->query($update_D)){
							$update_E = "	UPDATE $status 
											SET
											E_CARTERA_MORA_9 = D_CARTERA_MORA_9/D_CARTERA_TOTAL,
											E_COBRA_JUDI = D_COBRA_JUDI/D_CARTERA_TOTAL,
											E_CARTERA_VIGENTE_1_8 = D_CARTERA_VIGENTE_1_8/D_CARTERA_TOTAL
											";

							$this->mssql->query($update_E);
						}

				}
			}
		}
	}

	public function Listar_Temp_Status_Coloc($status){
		$sql = "	SELECT
					A_CARTERA_TOTAL,
					A_CARTERA_VIGENTE,
					A_COBRA_JUDI,
					A_CARTERA_1_A_8,
					A_CARTERA_9_A_30,
					A_CARTERA_31_A_60,
					A_CARTERA_61_A_90,
					A_CARTERA_91_A_120,
					A_CARTERA_121_A_360,
					A_CARTERA_MAS_360,
					B_CARTERA_MORA_1,
					B_COBRA_JUDI,
					B_CARTERA_VIGENTE,
					B_CARTERA_TOTAL,
					C_CARTERA_MORA_1,
					C_COBRA_JUDI,
					C_CARTERA_VIGENTE,
					D_CARTERA_MORA_9,
					D_COBRA_JUDI,
					D_CARTERA_VIGENTE_1_8,
					D_CARTERA_TOTAL,
					E_CARTERA_MORA_9,
					E_COBRA_JUDI,
					E_CARTERA_VIGENTE_1_8
					FROM
					$status
					ORDER BY E_CARTERA_MORA_9 DESC
					";

		$result = $this->mssql->query($sql);
		return $result;
	} 

}
