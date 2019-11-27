#VARIABLES A PASAR
Param(
	[int] $OP,
    [string] $COD,
	[string] $COD_CLIENTE,
	[string] $TD,
	[string] $EMIINI,
	[string] $EMIFIN,
	[string] $RUTARAIZ,
	[string] $FILENAME
)
<#EXPORTANDO DATOS DE LA BD SQL SERVER A UN ARCHIVO PLANO#>
# $a = Get-Date; 														# colocando fecha en una variable
# $fecha=$a.ToString("yyyy_MM_dd_HH_mm_ss"); 							# dandole formato a la fecha original
$pathfile = $RUTARAIZ+"documents\files\txt\"; 			# definiendo la ruta donde lo archivos seran trabajados
# $fileancii=$pathfile+"DOCS_DETCU_ANSI_"+$fecha+".txt"; 					# referencia del archivo ansi
$fileancii =$pathfile+$FILENAME+".txt"; 					# referencia del archivo ansi
#$fileutf8=$pathfile+"DOCS_UTF8_"+$fecha+".txt"; 					# referencia del archivo utf-8
#$namefile="DOCS_UTF8_"+$fecha+".txt";								# solo el nombre del archivo final
# bcp " EXEC RSFACCAR.dbo.SP_HISTORICO_DEUDA_DETALLE_XXX 1,'0002,0003,0004,0016','20133417452','FT,BV,NC','01/05/2019','25/07/2019'  " queryout $fileancii -c -T -w  -U sa -P Andinars08; # exportando la BD a un .txt con caracter ansi
 bcp " EXEC RSFACCAR.dbo.SP_HISTORICO_DEUDA_DETALLE_XXX $OP, '$COD', '$COD_CLIENTE', '$TD', '$EMIINI', '$EMIFIN' " queryout $fileancii -c -T -w  -U sa -P Andinars08; # exportando la BD a un .txt con caracter ansi
# Get-Content $fileancii | Set-Content -Encoding utf8 $fileutf8; 		# comando para convertir de ansi a utf-8
# Write-Output $OP
# Write-Output $COD
# Write-Output $COD_CLIENTE
# Write-Output $TD
# Write-Output $EMIINI
# Write-Output $EMIFIN
# Write-Output " EXEC RSFACCAR.dbo.SP_HISTORICO_DEUDA_DETALLE_XXX $OP, '$COD', '$COD_CLIENTE', '$TD', '$EMIINI', '$EMIFIN' "
# Write-Output $RUTARAIZ
# Write-Output $pathfile
# Write-Output $FILENAME
# Write-Output "Procesado"
