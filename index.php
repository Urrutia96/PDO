<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inicio</title>
	<link rel="stylesheet" href="">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</head>
<body>
	<br/>
	<br/>
	<?php 
		include('Controllers/UsuarioController.php');
		if(isset($_POST['nombre'])){
			$usuario = new UsuarioController();
			$nombre =$_POST['nombre'];
			$edad = $_POST['edad'];
			$telefono=$_POST['telefono'];
			$correo=$_POST['correo'];
			$var = $usuario->registrar($nombre,$edad,$telefono,$correo);
	 ?>

  	<div class="alert alert-success fade in">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    	<?php 
    		if ($var){
    			echo "<strong>Felicidades!</strong> Se ha Registrado con Exito.";
    		}else{
    			echo "<strong>Lo Sentimos</strong> Ha ocurrido un error.";
    		}
    	 ?>
    	
  	</div>
    <?php 
		}
	?>	
	<div class="container">
        <div class="row centered-form">

        <div class="col-xs-6 col-sm-4 col-md-2">
				
        <div class="sidebar-nav">
            <div class="well" style="width:300px; padding: 8px 0;">
        		<ul class="nav nav-list"> 
        		  <li class="nav-header">Menu</li>        
        		  <li class="active"><a href="index.php"><i class="icon-home"></i> Registrar</a></li>
        		  <li><a href="buscar.php"><i class="icon-edit"></i>Buscar</a></li>
        		</ul>
        	</div>
        </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Registrar Usuario</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form name="registro" role="form" method="post" action="index.php">
			    			<input type="hidden" name="accion" value="guardar">
			    			<div class="form-group">
			                	<input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre Completo" required>
			    			</div>
			    			<div class="form-group">
			                	<input type="text" name="edad" id="edad" class="form-control input-sm" placeholder="Edad" required>
			    			</div>
			    			<div class="form-group">
			                	<input type="text" name="telefono" id="telefono" class="form-control input-sm" placeholder="Telefono" required>
			    			</div>
			    			<div class="form-group">
			    				<input type="email" name="correo" id="correo" class="form-control input-sm" placeholder="Correo Electronico" required>
			    			</div>
			    			<input type="submit" value="Register" class="btn btn-info btn-block">
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

    <br/>
</body>
</html>