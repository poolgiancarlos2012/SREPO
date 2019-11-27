<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Repositorio de Documentos</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/Librerias/Metis/assets/lib/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/Librerias/fontawesome-5.9.0/css/fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/estilos.css">

</head>
<body style = "background: url(<?=base_url()?>public/Librerias/Metis/assets/img/pattern/irongrip.png) repeat #444;">

    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading" style="background-color: #fff;">
                    <div class="panel-title" style="font-family: Conv_futura_md_bt_bold;"> <img class="img-fluid" style="" src="<?=base_url()?>public/img/Logo_Custom2.png" alt=""></div>
                    <!-- <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div> -->
                </div>

                <div style="padding-top:30px;background-color: #e4e2e2;" class="panel-body">

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                    <form id="loginform" class="form-horizontal" role="form" onsubmit="return false;">

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="text" class="form-control" name="username" style="font-family: open_sanslight;" value="" placeholder="Usuario/DNI">
                        </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" style="font-family: open_sanslight;" placeholder="Password">
                        </div>

                        <div class="input-group">
                            <div class="checkbox">
                                <label>
                                    <input id="login-remember" type="checkbox" name="remember" value="1" style="width:13px;"> <span style="color:black;">Recordarme</span>
                                </label>
                            </div>
                        </div>

                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                                <!-- <a id="btn-login" href="#" class="btn btn-primary btn-block">Ingresar  </a> -->
                                <!-- <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a> -->
                                <button type="submit" id="btn-login" class="btn btn-primary btn-block" style="box-shadow: 0px 2px 6px 1px rgba(0, 0, 0, 0.56);">
                                    <!-- <i class="fa fa-search"></i> -->
                                    <span class="link-title">Ingresar</span>
                                </button>	
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 control">
                                <!-- <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                                Don't have an account! 
                                                <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                                    Sign Up Here
                                                </a>
                                            </div> -->

                                <ul class="list-inline" style="text-align: center;">
                                    <li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
                                    <li><a class="text-muted" href="#forgot" data-toggle="tab">Olvide el Password</a></li>
                                    <li><a class="text-muted" href="#signup" data-toggle="tab">Registrarse</a></li>
                                </ul>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign Up</div>
                    <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                </div>
                <div class="panel-body">
                    <form id="signupform" class="form-horizontal" role="form" >

                        <div id="signupalert" style="display:none" class="alert alert-danger">
                            <p>Error:</p>
                            <span></span>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="email" placeholder="Email Address">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-md-3 control-label">First Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="firstname" placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="passwd" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="icode" class="col-md-3 control-label">Invitation Code</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="icode" placeholder="">
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-md-offset-3 col-md-9">
                                <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                                <span style="margin-left:8px;">or</span>
                            </div>
                        </div>

                        <div style="border-top: 1px solid #999; padding-top:20px" class="form-group">

                            <div class="col-md-offset-3 col-md-9">
                                <button id="btn-fbsignup" type="button" class="btn btn-primary"><i class="icon-facebook"></i>   Sign Up with Facebook</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

<script type='text/javascript' src="<?php echo base_url(); ?>public/Librerias/Metis/assets/lib/jquery/jquery.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>public/Librerias/Metis/assets/lib/bootstrap/js/bootstrap.js"></script>

<script type='text/javascript' src="<?php echo base_url(); ?>public/js/brain/JS_Login.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>public/js/brain/AJAX_Login.js"></script>

</body>
</html> 