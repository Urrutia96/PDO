<?php 
include('Models/Usuario.php');
	class UsuarioController{

		private $id;
		public $nombre;
		public $edad;
		public $telefono;
		public $correo;
		private $usuario = null;
		function __construct(){
			$this->usuario = new Usuario(); 
		}
		public function buscar($id){
			$this->id = (int) $id;
			$this->usuario->setId($this->id);
			$result = $this->usuario->buscarPorId();
			return $result;
		}
		public function buscarTodo(){
			$todos = $this->usuario->buscarTodo();
			return $todos; 
		}
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
