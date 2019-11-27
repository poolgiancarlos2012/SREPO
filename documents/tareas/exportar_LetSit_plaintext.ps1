#VARIABLES A PASAR
Param(
	[int] $OP,
    [string] $COD,
    [string] $RUTARAIZ,
	[string] $FILENAME
)

$pathfile = $RUTARAIZ+"documents\files\txt\"; 			# definiendo la ruta donde lo archivos seran trabajados
$fileancii =$pathfile+$FILENAME+".txt";
bcp " EXEC RSFACCAR.dbo.SP_LETRA_X_SITUACION $OP, '$COD' " queryout $fileancii -T -c -C ACP -e  -U sa -P Andinars08;