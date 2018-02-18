<?php 
/**
* @author Santos Osmin Urrutia Iraheta
*/
include('Models/Usuario.php');
	class UsuarioController{
		private $id;
		//Se declara la variable en la que vamos a guardar la instancia de
		//la clase modelo Usuario
		private $usuario = null;
		//Declaramos la instancia a la clase usuario desde la creacion de la instancia dela clase UsuarioController
		function __construct(){
			$this->usuario = new Usuario(); 
		}

		//Solamente se recibe el id, hace la peticion al modelo y retorna un objeto de tipo Usuario
		public function buscar($id){
			$this->id = (int) $id;
			$this->usuario->setId($this->id);
			$result = $this->usuario->buscarPorId();
			return $result;
		}
		//Se hace la peticion a la clase Usuario para que retorne un objeto con todos los registros
		public function buscarTodo(){
			$todos = $this->usuario->buscarTodo();
			return $todos; 
		}
		//Recibe todos los parametro para hacer un nuevo registro
		public function registrar($nombre,$edad,$telefono,$correo){
			$this->usuario->setNombre($nombre);
			$this->usuario->setEdad($edad);
			$this->usuario->setTelefono($telefono);
			$this->usuario->setCorreo($correo);
			if($this->usuario->guardar()){
				return true;
			}else{
				return false;
			}
		}
		//Apartir del id se modificara el registro
		public function modificar($id,$nombre,$edad,$telefono,$correo){
			$this->usuario->setId($id);
			$this->usuario->setNombre($nombre);
			$this->usuario->setEdad($edad);
			$this->usuario->setTelefono($telefono);
			$this->usuario->setCorreo($correo);
			if($this->usuario->modificar()){
				return true;
			}else{
				return false;
			}
		}
		//Solamente se recibe el id del registro que se quiere eliminar
		public function eliminar($id){
			$this->id = (int) $id;
			$this->usuario->setId($this->id);
			if($this->usuario->eliminar()){
				return true;
			}else{
				return false;
			}
		}
	}
 ?>
