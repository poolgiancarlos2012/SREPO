<?php
class Model_Ingresar extends CI_Model {

    var $mssql;
    function __construct() {
		parent::__construct();
		$this->load->dbforge();
		$this->mssql = $this->load->database('default', TRUE );
		$this->load->library('session');
	}

	function Validar_Acceso($usu, $pass){
		
		// $query = "	SELECT 
		// 			DNI AS USUARIO,
		// 			VEND AS NOMBRE
		// 			FROM 
		// 			VIEW_DISTRIBUCION_PERSONAL 
		// 			WHERE 
		// 			EMPRESA IN ('CAISAC','SUPERV_CRED','OPERACIONES','ADMINISTRADOR','GERENCIA','JEFE_OPE','CONTABILIDAD','MARKETING') AND
		// 			DNI='$usu' AND
		// 			SUBSTRING(sys.fn_sqlvarbasetostr(HASHBYTES('MD5', DNI)),3,32)=SUBSTRING(sys.fn_sqlvarbasetostr(HASHBYTES('MD5', '$pass')),3,32)";

        $query = "	SELECT
					USERS.IDUSUARIO,
                    EMPLEADO.NOMBRE,
                    EMPLEADO.PATERNO,
                    EMPLEADO.MATERNO,
                    USERS.USUARIO,
                    TIPO_USUARIO.NOMBRE AS TIPO_USUARIO
                    FROM
                    USERS
                    INNER JOIN EMPLEADO ON USERS.IDEMPLEADO = EMPLEADO.IDEMPLEADO
                    INNER JOIN TIPO_USUARIO ON TIPO_USUARIO.IDTIPO_USUARIO = USERS.IDTIPO_USUARIO
                    WHERE
                    USERS.USUARIO = '$usu' AND
                    CAST(DecryptByPassPhrase('ClaveUsuarios',USERS.CLAVE) AS VARCHAR(200)) = '$pass' AND
                    USERS.ESTADO = 1 ";


        $rstquery = $this->mssql->query($query);
		
		if($rstquery->num_rows() != 0) {
			return true;
		} else {
			return false;
		}

	}

	function Obtener_Informacion($usu, $pass){
		
		// $query = "	SELECT 
		// 			DNI AS USUARIO,
		// 			VEND AS NOMBRE
		// 			FROM 
		// 			VIEW_DISTRIBUCION_PERSONAL 
		// 			WHERE 
		// 			EMPRESA IN ('CAISAC','SUPERV_CRED','OPERACIONES','ADMINISTRADOR','GERENCIA','JEFE_OPE','CONTABILIDAD','MARKETING') AND
		// 			DNI='$usu' AND
		// 			SUBSTRING(sys.fn_sqlvarbasetostr(HASHBYTES('MD5', DNI)),3,32)=SUBSTRING(sys.fn_sqlvarbasetostr(HASHBYTES('MD5', '$pass')),3,32)";

        $query = "	SELECT
					USERS.IDUSUARIO,
                    EMPLEADO.NOMBRE,
                    EMPLEADO.PATERNO,
                    EMPLEADO.MATERNO,
                    USERS.USUARIO,
                    TIPO_USUARIO.NOMBRE AS TIPO_USUARIO
                    FROM
                    USERS
                    INNER JOIN EMPLEADO ON USERS.IDEMPLEADO = EMPLEADO.IDEMPLEADO
                    INNER JOIN TIPO_USUARIO ON TIPO_USUARIO.IDTIPO_USUARIO = USERS.IDTIPO_USUARIO
                    WHERE
                    USERS.USUARIO = '$usu' AND
                    CAST(DecryptByPassPhrase('ClaveUsuarios',USERS.CLAVE) AS VARCHAR(200)) = '$pass' AND
                    USERS.ESTADO = 1 ";

		$rstquery = $this->mssql->query($query);
		return $rstquery->result_array();
    }
    
    

}
