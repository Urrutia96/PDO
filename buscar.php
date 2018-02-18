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

    </div>
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
        <div class="col-xs-12 col-sm-10 col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <h3 class="panel-title">Buscar Usuario</h3>
                        </div>
                        <div class="panel-body">
                        <form action="buscar.php" method="post" accept-charset="utf-8">
                        <div class="search">
                            <input type="hidden" name="accion" value="buscar">
                            <input type="text" class="form-control input-sm" maxlength="64" placeholder="Id" name="id" />
                            <button type="submit" class="btn btn-primary btn-sm" name="buscar" value="buscar">Search</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
include('Controllers/UsuarioController.php');
    if(isset($_POST['eliminar'])){
        $usuario = new UsuarioController();
        if($usuario->eliminar($_POST['id'])){
?>
<div class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>Felicidades</strong>Se elmino correctamente
</div>
<?php            
        }else{
            ?>

<div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <strong>Lo sentimos </strong>Ocurrio un problema
</div>
            <?php
        }

    }
 ?>
<div class="container">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th class="td-actions">Acción</th>
            </tr>
        </thead>
        <tbody>
            <form action="buscar.php" method="POST" accept-charset="utf-8">
            <?php 
                $usuario = new UsuarioController();
                if (isset($_POST['buscar']) && $_POST['buscar'] !== 0) {
                    $array = $usuario->buscar($_POST['id']);
                    echo "<tr><td>";
                    echo $array->getId() . "</td>";
                    echo "<td>".$array->getNombre()."</td><td>".$array->getEdad()."</td><td>".$array->getTelefono();
                    echo "</td><td>".$array->getCorreo()."</td>";
                    echo "<td><button type=\"submit\" class=\"btn btn-danger btn-sm\" name=\"eliminar\" value=\"".$array->getId()."\">Eliminar</button></td>";
                    echo "</tr>";
                }else{
                    $todo = $usuario->buscarTodo();
                    if($todo){
                    foreach ($todo as $user ) {
                        echo "<tr><td>";
                        echo $user['id'] . "</td>";
                        echo "<td>".$user['nombre']."</td><td>".$user['edad']."</td><td>".$user['telefono'];
                        echo "</td><td>".$user['correo']."</td>";
                        echo "<td><input type=\"hidden\" name=\"id\" value=\"".$user['id']."\"><button type=\"submit\" class=\"btn btn-danger btn-sm\" name=\"eliminar\" value=\"".$user['id']."\">Eliminar</button> ";
                        echo "<a href=\"modificar.php?id=".$user['id']."\" class=\"btn btn-info btn-sm\">Modificar</a></td>";
                        echo "</tr>";
                    }
                    }
                }
             ?>
             </form>
        </tbody>
    </table>
    
</div>
    <br/>
</body>
</html>

