<!DOCTYPE html>
<html lang="es">
<?php
    if(!isset($this->session->userdata['logged_in'])) { // Si no se ha iniciado logueo o session de algun usuario te muestra la pantalla de logueo
        header("location: ".base_url("Ingresar"));
    } 
    else { // imprimo el contenido de la session
        //print_r($this->session->userdata);
        //$ar_data = $this->session->userdata;
    }
?>
<head>
	<meta charset="UTF-8">
	<!--IE Compatibility modes-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--Mobile first-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="msapplication-TileColor" content="#5bc0de" />
	<meta name="msapplication-TileImage" content="../public/Librerias/Metis/assets/img/metis-tile.png" />
	<title><?php echo $this->title; ?></title>
	<meta name="description" content="<?php echo $this->keywords; ?>">
	<meta name="keywords" content="<?php echo $this->descripcion; ?>" />

	<?php echo $this->css; ?> 

	<!--For Development Only. Not required -->
	<script>
	less = {
		env: "development",
		relativeUrls: false,
		rootpath: "/assets/"
	};
	</script>
	<link rel="stylesheet/less" type="text/css" href="<?php echo base_url()?>public/Librerias/Metis/assets/less/theme.less">
	<script src="<?php echo base_url()?>public/Librerias/less.js"></script>
</head>
<body>

<div class="bg-dark dk" id="wrap">

	<div id="top">
		<!-- .navbar -->
		<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container-fluid">

				<!-- Brand and toggle get grouped for better mobile display -->
				<header class="navbar-header">

					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="index.html" class="navbar-brand"><img src="<?php echo base_url()?>public/img/GRUPOANDINA2.png" alt=""></a>

				</header>

				<div class="topnav">
					<div class="btn-group">
						<a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip" class="btn btn-default btn-sm" id="toggleFullScreen">
							<i class="glyphicon glyphicon-fullscreen"></i>
						</a>
					</div>
					<div class="btn-group">
						<a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip" class="btn btn-default btn-sm">
							<i class="fa fa-envelope"></i>
							<span class="label label-warning">5</span>
						</a>
						<a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
							<i class="fa fa-comments"></i>
							<span class="label label-danger">4</span>
						</a>
						<a data-toggle="modal" data-original-title="Help" data-placement="bottom" class="btn btn-default btn-sm" href="#helpModal">
							<i class="fa fa-question"></i>
						</a>
					</div>
					<div class="btn-group" id="btnsalir">
						<div data-toggle="tooltip" data-original-title="Salir" data-placement="bottom" class="btn btn-metis-1 btn-sm">
							<i class="fa fa-power-off"></i>
						</div>
					</div>
					<div class="btn-group">
						<a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip" class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
							<i class="fa fa-bars"></i>
						</a>
						<a href="#right" data-toggle="onoffcanvas" class="btn btn-default btn-sm" aria-expanded="false">
							<span class="fa fa-fw fa-comment"></span>
						</a>
					</div>

				</div>

				<div class="collapse navbar-collapse navbar-ex1-collapse">

					<!-- .nav -->
					<ul class="nav navbar-nav">
						<li><a href="dashboard.html">Dashboard</a></li>
						<li><a href="table.html">Tables</a></li>
						<li class='dropdown '>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Form Elements <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="form-general.html">General</a></li>
								<li><a href="form-validation.html">Validation</a></li>
								<li><a href="form-wysiwyg.html">WYSIWYG</a></li>
								<li><a href="form-wizard.html">Wizard &amp; File Upload</a></li>
							</ul>
						</li>
					</ul>
					<!-- /.nav -->
				</div>
			</div>
			<!-- /.container-fluid -->
		</nav>
		<!-- /.navbar -->
		<header class="head">
			<div class="search-bar">
				<form class="main-search" action="">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Live Search ...">
						<span class="input-group-btn">
								<button class="btn btn-primary btn-sm text-muted" type="button">
										<i class="fa fa-search"></i>
								</button>
						</span>
					</div>
				</form>
				<!-- /.main-search -->
			</div>
			<!-- /.search-bar -->
			<div class="main-bar">
				<h3>
					<i class="fa fa-home"></i>&nbsp;
					Grupo Andina SAC
				</h3>
			</div>
			<!-- /.main-bar -->
		</header>
		<!-- /.head -->
	</div>
	<!-- /#top -->

	<div id="left">
		<div class="media user-media bg-dark dker">
			<div class="user-media-toggleHover">
				<span class="fa fa-user"></span>
			</div>
			<div class="user-wrapper bg-dark">
				<a class="user-link" href="">
					<img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url()?>public/img/3D-User-Male-64">
					<span class="label label-danger user-label">16</span>
				</a>

				<div class="media-body">
					<span class="media-heading" style="font-size: 10px;">&nbsp;<?php echo $this->session->userdata['logged_in']['nombre']." ".$this->session->userdata['logged_in']['paterno']." ".$this->session->userdata['logged_in']['materno'];?></span>
					<ul class="list-unstyled user-info">
						<li><a href=""><?php echo $this->session->userdata['logged_in']['tipo_usuario'];?></a></li>
						<li>Last Access :
							<br>
							<small><i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32</small>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- #menu -->
		<ul id="menu" class="bg-blue dker">
			<li class="nav-header">Menu</li>
			<li class="nav-divider"></li>
			<li class="">
				<a href="dashboard.html">
					<i class="fa fa-chart-pie" style="color:#6aa22e82"></i><span class="link-title">&nbsp;Dashboard</span>
				</a>
			</li>
			<!-- <li class="nav-header">Vistas</li>
			<li class="nav-divider"></li>

			<li class="">
				<a href="javascript:;">
					<i class="fa fa-users " style="color:#6f4a2ffa"></i>
					<span class="link-title">Cliente</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="collapse">
					<li>
						<a href="<?php echo base_url()?>index/base_cliente">
							<i class="fa fa-angle-right"></i>&nbsp; Base de Clientes </a>
					</li>
					<li>
						<a href="fixed-header-boxed.html">
							<i class="fa fa-angle-right"></i>&nbsp; Linea de Credito </a>
					</li>
					<li>
						<a href="fixed-header-fixed-mini-sidebar.html">
							<i class="fa fa-angle-right"></i>&nbsp; Direccion del Cliente </a>
					</li>

				</ul>
			</li> -->
			<!-- <li class="nav-header">Funcionalidad</li>
			<li class="nav-divider"></li>
			<li class=""> -->
				<!-- <a href="javascript:;">
					<i class="fa fa-file-invoice-dollar" style="color:#2e7ca2fa"></i>
					<span class="link-title">Estados de Cuenta</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="collapse">
					<li>
						<a href="bgcolor.html">
							<i class="fa fa-angle-right"></i>&nbsp; Por Cliente </a>
					</li>
					<li>
						<a href="bgimage.html">
							<i class="fa fa-angle-right"></i>&nbsp; Por Fecha </a>
					</li>
					<li>
						<a href="button.html">
							<i class="fa fa-angle-right"></i>&nbsp; Envio Masivo </a>
					</li>
					<li>
						<a href="icon.html">
							<i class="fa fa-angle-right"></i>&nbsp; Sunny </a>
					</li>
				</ul>
			</li>

			<li class="">
				<a href="javascript:;">
					<i class="fa fa-file-invoice" style="color:#88881efa"></i>
					<span class="link-title">Gerencial</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="collapse">
					<li>
						<a href="bgcolor.html">
							<i class="fa fa-angle-right"></i>&nbsp; Oficina </a>
					</li>
					<li>
						<a href="bgimage.html">
							<i class="fa fa-angle-right"></i>&nbsp; Tiendas </a>
					</li>
					<li>
						<a href="button.html">
							<i class="fa fa-angle-right"></i>&nbsp; Catigados </a>
					</li>
				</ul>
			</li>

			<li class="">
				<a href="javascript:;">
					<i class="fa fa-history" style="color:#c200ff82"></i>
					<span class="link-title">Historicos</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="collapse">
					<li>
						<a href="bgcolor.html">
							<i class="fa fa-angle-right"></i>&nbsp; Pagos </a>
					</li>
					<li>
						<a href="bgimage.html">
							<i class="fa fa-angle-right"></i>&nbsp; Cuentas </a>
					</li>
					<li>
						<a href="<?php echo base_url()?>index/historico_detalle_cuenta">
							<i class="fa fa-angle-right"></i>&nbsp; Detalle de las Cuentas </a>
					</li>
				</ul>
			</li> -->

            <li class="">
				<a href="javascript:;">
					<i class="fa fa-tag" style="color:#2980E4"></i>
					<span class="link-title">Ventas</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="collapse">
					<li>
						<a href="bgcolor.html">
							<i class=""></i>&nbsp; Cuentas y su Detalle stock </a>
					</li>
					<li>
						<a href="bgimage.html">
							<i class=""></i>&nbsp; Pedidos </a>
					</li>
					<!-- <li>
						<a href="<?php echo base_url()?>index/historico_detalle_cuenta">
							<i class="fa fa-angle-right"></i>&nbsp; Detalle de las Cuentas </a>
					</li> -->
				</ul>
			</li>

            <li class="">
				<a href="javascript:;">
					<i class="fa fa-eye" style="color:#c200ff82"></i>
					<span class="link-title">Supervision</span>
					<span class="fa arrow"></span>
				</a>
				<ul class="collapse">
					<li>
						<a href="bgcolor.html">
							<i class=""></i>&nbsp; Linea de Creditos </a>
					</li>
					<!-- <li>
						<a href="bgimage.html">
							<i class="fa fa-angle-right"></i>&nbsp; Cuentas </a>
					</li>
					<li>
						<a href="<?php echo base_url()?>index/historico_detalle_cuenta">
							<i class="fa fa-angle-right"></i>&nbsp; Detalle de las Cuentas </a>
					</li> -->
				</ul>
			</li>

			<li>
				<a href="javascript:;">
					<i class="fa fa-calculator" style="color:#6d0d0dbd"></i>
					<span class="link-title"> Operaciones y Creditos </span>
					<span class="fa arrow"></span>
				</a>
				<ul class="collapse">
					<li>
						<a href="javascript:;">Letras  <span class="fa arrow"></span>  </a>
						<ul class="collapse">
							<li> <a href="<?php echo base_url()?>index/letras_x_situacion">Letras x Situación</a> </li>
							<li> <a href="javascript:;">Letras 2</a> </li>
                            <!-- <li> <a href="javascript:;">Historico</a> </li>
                            <li> <a href="javascript:;">Estados de Cuenta</a> </li> -->
						</ul>
					</li>
                    <li>
						<a href="javascript:;">Estado de Cuenta  <span class="fa arrow"></span>  </a>
						<ul class="collapse">
							<li> <a href="<?php echo base_url()?>index/letras_x_situacion">EstCue x Cliente</a> </li>
                            <li> <a href="<?php echo base_url()?>index/letras_x_situacion">EstCue x Fecha</a> </li>
                            <li> <a href="<?php echo base_url()?>index/letras_x_situacion">EstCue Envio Masivo @</a> </li>
                            <li> <a href="<?php echo base_url()?>index/letras_x_situacion">Gerencial Cliente</a> </li>
                            <li> <a href="<?php echo base_url()?>index/letras_x_situacion">Gerencial Tiendas</a> </li>
                            <li> <a href="<?php echo base_url()?>index/letras_x_situacion">Gerencial Castigados</a> </li>

						</ul>
					</li>
                    <li>
						<a href="javascript:;">Historicos  <span class="fa arrow"></span>  </a>
						<ul class="collapse">
							<li> <a href="<?php echo base_url()?>brain/Ctrl_Operaciones_Creditos/View_Cuenta_Detalle">Pagos</a> </li>
							<li> <a href="javascript:;">Cuentas</a> </li>
                            <li> <a href="<?php echo base_url()?>brain/Ctrl_Operaciones_Creditos/View_Cuenta_Detalle">Cuentas y su Detalle</a> </li>
						</ul>
					</li>
				</ul>
			</li>

			<li class="nav-divider"></li>
			<li>
				<a href="login.html">
					<i class="fa fa-cog" style="color:#FFFFFF"></i>
					<span class="link-title"> Configuracion</span>
                    <span class="fa arrow"></span>
				</a>
                <ul class="collapse">
					<li>
						<a href="bgcolor.html">Usuarios </a>
					</li>
					<!-- <li>
						<a href="bgimage.html">
							<i class="fa fa-angle-right"></i>&nbsp; Cuentas </a>
					</li>
					<li>
						<a href="<?php echo base_url()?>index/historico_detalle_cuenta">
							<i class="fa fa-angle-right"></i>&nbsp; Detalle de las Cuentas </a>
					</li> -->
				</ul>
			</li>
		</ul>
		<!-- /#menu -->
	</div>
	<!-- /#left -->

	<div id="content">
		<div class="outer">
			<div class="inner bg-light lter">
				<?php echo $content; ?>
			</div>
			<!-- /.inner -->
		</div>
		<!-- /.outer -->
	</div>
	<!-- /#content -->


	<div id="right" class="onoffcanvas is-right is-fixed bg-light" aria-expanded=false>
		<a class="onoffcanvas-toggler" href="#right" data-toggle=onoffcanvas aria-expanded=false></a>
		<br>
		<br>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Warning!</strong> Best check yo self, you're not looking too good.
		</div>
		<!-- .well well-small -->
		<div class="well well-small dark">
			<ul class="list-unstyled">
				<li>Visitor <span class="inlinesparkline pull-right">1,4,4,7,5,9,10</span></li>
				<li>Online Visitor <span class="dynamicsparkline pull-right">Loading..</span></li>
				<li>Popularity <span class="dynamicbar pull-right">Loading..</span></li>
				<li>New Users <span class="inlinebar pull-right">1,3,4,5,3,5</span></li>
			</ul>
		</div>
		<!-- /.well well-small -->
		<!-- .well well-small -->
		<div class="well well-small dark">
			<button class="btn btn-block">Default</button>
			<button class="btn btn-primary btn-block">Primary</button>
			<button class="btn btn-info btn-block">Info</button>
			<button class="btn btn-success btn-block">Success</button>
			<button class="btn btn-danger btn-block">Danger</button>
			<button class="btn btn-warning btn-block">Warning</button>
			<button class="btn btn-inverse btn-block">Inverse</button>
			<button class="btn btn-metis-1 btn-block">btn-metis-1</button>
			<button class="btn btn-metis-2 btn-block">btn-metis-2</button>
			<button class="btn btn-metis-3 btn-block">btn-metis-3</button>
			<button class="btn btn-metis-4 btn-block">btn-metis-4</button>
			<button class="btn btn-metis-5 btn-block">btn-metis-5</button>
			<button class="btn btn-metis-6 btn-block">btn-metis-6</button>
		</div>
		<!-- /.well well-small -->
		<!-- .well well-small -->
		<div class="well well-small dark">
			<span>Default</span><span class="pull-right"><small>20%</small></span>

			<div class="progress xs">
				<div class="progress-bar progress-bar-info" style="width: 20%"></div>
			</div>
			<span>Success</span><span class="pull-right"><small>40%</small></span>

			<div class="progress xs">
				<div class="progress-bar progress-bar-success" style="width: 40%"></div>
			</div>
			<span>warning</span><span class="pull-right"><small>60%</small></span>

			<div class="progress xs">
				<div class="progress-bar progress-bar-warning" style="width: 60%"></div>
			</div>
			<span>Danger</span><span class="pull-right"><small>80%</small></span>

			<div class="progress xs">
				<div class="progress-bar progress-bar-danger" style="width: 80%"></div>
			</div>
		</div>
	</div>
	<!-- /#right -->

</div>
<!-- /#wrap -->

<footer class="Footer bg-dark dker">
    <p>Copyright &copy; 2019 Grupo Andina S.A.C. Terms of the Use &#124; Privacy Policy</p>
</footer>
<!-- /#footer


<!-- #helpModal -->
<div id="helpModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
	
<?php echo $this->js; ?>

</body>
</html>
