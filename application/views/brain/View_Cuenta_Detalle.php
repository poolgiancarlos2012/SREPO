<input type="hidden" id="tmp_name_table">
<h4 class="colortexto sombratext-2"><b>Historico detalle Cuenta</b></h4>

<form class="form" id="FormDetCu" onsubmit="return false;" data-tipo="">
	<div class="form-group row">
		<div class="col-lg-6">
			<label for="fchemiini"><span class="colortexto">Fecha Emision Desde</span></label>
			<div class="input-group date  col-md-5" id="fchemiini" data-date="" data-date-format="dd/mm/yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd" style="width:100%;box-shadow: 0px 2px 6px 1px rgba(0, 0, 0, 0.56);" >
				<!-- <input class="form-control" size="100%" type="text" value="" id="txtfchemiini"  required oninvalid="this.setCustomValidity('Please upload document xxx')" > Validacion a nivel html -->
				<input class="form-control" size="100%" type="text" value="" id="txtfchemiini" autocomplete="off" >
				<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			</div>
			<input type="hidden" id="dtp_input1" value="" />
		</div>
		<div class="col-lg-6">
			<label for="fchemifin"><span class="colortexto">Fecha Emision Hasta</span></label>
			<div class="input-group date  col-md-5" id="fchemifin" data-date="" data-date-format="dd/mm/yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;box-shadow: 0px 2px 6px 1px rgba(0, 0, 0, 0.56);">
				<input class="form-control" size="100%" type="text" value="" id="txtfchemifin" autocomplete="off" >
				<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			</div>
			<input type="hidden" id="dtp_input2" value="" />
		</div>
	</div>

	<div class="form-group row">
		<div class="col-lg-12">
			<label for="txtcod_cliente"><span class="colortexto">Cliente <i id="searchcliente" class="glyphicon glyphicon-refresh" style="z-index: 1;"></i></span></label>
			<!-- <input type="text" placeholder="" class="typeahead form-control" id="txtcod_cliente" style="box-shadow: 0px 2px 6px 1px rgba(0, 0, 0, 0.56);" autocomplete="off"> -->
			<div class="inner-addon right-addon">
				
				<input type="text" class="form-control" id="txtcod_cliente" style="box-shadow: 0px 2px 6px 1px rgba(0, 0, 0, 0.56);" autocomplete="off"/>
			</div>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-lg-6">
			<input type="hidden" id="hdcbo_empresa" >
			<label for="cbo_empresa"><span class="colortexto">Empresa</span></label>
			<div class="input-group my-group" style="box-shadow: 0px 2px 6px 1px rgba(0, 0, 0, 0.56);width:100%;"> 
				<select id="cbo_empresa" multiple="multiple" >
					<option value="0002">CAISAC</option>
					<option value="0003">ANDEX</option>
					<option value="0004">SEMILLAS</option>
					<option value="0016">SUNNY</option>
				</select>
				<!-- <span class="input-group-btn">
					<button id="btn_empresa-deselectAll-all" style="z-index: 1;" class="btn btn-default my-group-button" type="submit"><span class="glyphicon glyphicon-remove"></span></button>
				</span> -->
			</div>
		</div>		
		<div class="col-lg-6">
		<input type="hidden" id="hdcbo_documentos">
			<label for="cbo_documentos"><span class="colortexto">Documento</span></label>
			<div class="input-group my-group" style="box-shadow: 0px 2px 6px 1px rgba(0, 0, 0, 0.56);width:100%;"> 		
				<select id="cbo_documentos" multiple="multiple">
					<option value="FT">FACTURA</option>
					<option value="BV">BOLETA</option>
					<option value="NC">NOTA CREDITO</option>
				</select>	
				<!-- <span class="input-group-btn">
					<button id="btn_documentos-deselectAll-all" style="z-index: 1;" class="btn btn-default my-group-button" type="submit"><span class="glyphicon glyphicon-remove"></span></button>
				</span> -->
			</div>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-lg-12" style="text-align:center;">
			<button type="submit" id="btnconsultar" class="btn btn-primary btn-sm" style="box-shadow: 0px 2px 6px 1px rgba(0, 0, 0, 0.56);" onclick='$("form").attr("data-tipo","cons");'>
				<i class="fa fa-search"></i>
				<span class="link-title">&nbsp;Consultar</span>
			</button>		
			&nbsp;&nbsp;&nbsp;
			<div class="btn-group dropup"> <!-- class dropup  -->
				<button type="submit" class="btn  btn-sm btn-descarga" id="btnexport" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" onclick='$("form").attr("data-tipo","desc");'>Descargar</button>
				<button type="button" class="btn  btn-sm btn-descarga dropdown-toggle" data-toggle="dropdown">
				
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
				</button>
				<ul class="dropdown-menu" role="menu" id="FormatDownload">
					<li><a>.xlsx</a></li>
					<li><a>Plain Text</a></li>
					<!-- <li><a href="#">Paste</a></li>
					<li class="divider"></li>
					<li><a href="#">Delete</a></li> -->
				</ul>
			</div>
			&nbsp;&nbsp;&nbsp;
			<span class="colortexto" id="extensiondwonload"></span>
		</div>	
	</div>
</form>
<br/>
<br/>
<!-- Modal -->
<div class="modal modal-default fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Descarga de Detalle Cuenta en el formato <strong  id="formatodescarga"></strong> </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
					<h3 id="tituloDescarga">Explorando información</h3>
					<div class="progress">
						<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" data-progress="0" style="width: 0%;">
							0%
						</div>
					</div>
					<div class="counter-sending">
						(<span id="done">0</span>/<span id="total">0</span>)
					</div>

					<div class="execute-time-content">
						Tiempo transcurrido: <span class="execute-time">0 segundos</span>
					</div>

					<br/>
					<textarea readonly id="rstdetcu" class="form-control" id="exampleFormControlTextarea1" rows="10" style="font-size: 8px;display: none;"></textarea>
					<br/>
					
					<div class="end-process" style="display:none;">
						<div class="alert alert-success" id="msjdownload">
							
						</div>
					</div>    
			</div>
			
			<div class="modal-footer" style="display:none">
				<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button> -->
			</div>
		</div>
	</div>
</div>

<div class="modal modal-warning" id="alerta_formato" aria-hidden="false" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Aviso!</h4>
			</div>
			<div class="modal-body">
				<p>Seleccionar el <code>Fomato</code> para la descarga</p>
			</div><!-- /.modal-body -->
			<div class="modal-footer">
				<!-- <div class="btn-group btn-group-justified" data-toggle="buttons"> -->

					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>

					<!-- <label class="btn btn-default">
						<input type="radio" name="modal-style" id="modal-default"> Default
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="modal-style" id="modal-primary"> Primary
					</label>
					<label class="btn btn-danger">
						<input type="radio" name="modal-style" id="modal-danger"> Danger
					</label>
					<label class="btn btn-warning">
						<input type="radio" name="modal-style" id="modal-warning"> Warning
					</label>
					<label class="btn btn-info">
						<input type="radio" name="modal-style" id="modal-info"> Info
					</label> -->
				<!-- </div> -->
			</div><!-- /.modal-footer -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal modal-info" id="alerta_formato_cero" aria-hidden="false" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Informacion</h4>
			</div>
			<div class="modal-body">
				<p><code>No existe Informacion</code> con los filtros de busqueda.</p>
			</div><!-- /.modal-body -->
			<div class="modal-footer">
				<!-- <div class="btn-group btn-group-justified" data-toggle="buttons"> -->

					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>

					<!-- <label class="btn btn-default">
						<input type="radio" name="modal-style" id="modal-default"> Default
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="modal-style" id="modal-primary"> Primary
					</label>
					<label class="btn btn-danger">
						<input type="radio" name="modal-style" id="modal-danger"> Danger
					</label>
					<label class="btn btn-warning">
						<input type="radio" name="modal-style" id="modal-warning"> Warning
					</label>
					<label class="btn btn-info">
						<input type="radio" name="modal-style" id="modal-info"> Info
					</label> -->
				<!-- </div> -->
			</div><!-- /.modal-footer -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal modal-info" id="alerta_formato_cliente" aria-hidden="false" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Informacion</h4>
			</div>
			<div class="modal-body">
				<p><code>Cliente no Seleccionado,</code> ingresar Cliente.</p>
			</div><!-- /.modal-body -->
			<div class="modal-footer">
				<!-- <div class="btn-group btn-group-justified" data-toggle="buttons"> -->

					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>

					<!-- <label class="btn btn-default">
						<input type="radio" name="modal-style" id="modal-default"> Default
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="modal-style" id="modal-primary"> Primary
					</label>
					<label class="btn btn-danger">
						<input type="radio" name="modal-style" id="modal-danger"> Danger
					</label>
					<label class="btn btn-warning">
						<input type="radio" name="modal-style" id="modal-warning"> Warning
					</label>
					<label class="btn btn-info">
						<input type="radio" name="modal-style" id="modal-info"> Info
					</label> -->
				<!-- </div> -->
			</div><!-- /.modal-footer -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

