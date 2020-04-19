<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('PHPExcel-1.x.x/PHPExcel.php');
require_once('PHPExcel-1.x.x/PHPExcel/Cell/AdvancedValueBinder.php');

class Excel extends PHPExcel
{
	public function __construct()
	{
		parent::__construct();
	}
}


?>
