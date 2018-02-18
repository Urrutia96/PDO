<?php 
/**
* @author Santos Osmin Urrutia 
*/
require_once('Connector.php');
class Usuario{
	private $id;
	private $nombre;
	private $edad;
	private $telefono;
	private $correo;
	private $result = null;

	private $conn = null;
	function __construct($id=null,$nombre=null,$edad=null,$telefono=null,$correo=null){
		$model = new Connector();
		$this->conn = $model->getConexion();
		$this->id = $id;
		$this->nombre = $nombre;
		$this->edad = $edad;
		$this->telefono = $telefono;
		$this->correo = $correo;
	}

	//Setters
	public function setId($id){
		$this->id = $id;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function setEdad($edad){
		$this->edad = $edad;
	}
	public function setTelefono($telefono){
		$this->telefono = $telefono;
	}
	public function setCorreo($correo){
		$this->correo = $correo;
	}
	//Getters
	public function getId(){
		return $this->id;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function getEdad(){
		return $this->edad;
	}
	public function getTelefono(){
		return $this->telefono;
	}
	public function getCorreo(){
		return $this->correo;
	}


	public function guardar(){
		$sql = "INSERT INTO usuario (nombre, edad, telefono, correo) VALUES (:nombre, :edad, :telefono, :correo)";
		$statement = $this->conn->prepare($sql);
		$statement->bindParam(':nombre', $this->nombre);
		$statement->bindParam(':edad', $this->edad);
		$statement->bindParam(':telefono', $this->telefono);
		$statement->bindParam(':correo', $this->correo);
		if($statement){
			$statement->execute();
			return true;
		}else{
			return false;			
		}
	}

	public function buscarPorId(){
		$sql = "SELECT  nombre, edad, telefono, correo FROM usuario WHERE id = :id";
		$statement = $this->conn->prepare($sql);
		$statement->bindParam(':id',$this->id);
		$statement->execute();
		$this->result = $statement->fetch();
		return new self($this->id,$this->result['nombre'],$this->result['edad'],$this->result['telefono'],$this->result['correo']);	
	}

	public function buscarTodo(){
		$sql = "SELECT id, nombre, edad, telefono, correo FROM usuario";
		$statement = $this->conn->prepare($sql);
		$statement->execute();
		$this->result = $statement->fetchAll();
		if ($this->result) {
			return $this->result;
		}
	}

	public function eliminar(){
		$sql = "DELETE FROM usuario WHERE id = :id";
		$statement = $this->conn->prepare($sql);
		$statement->bindParam(':id',$this->id);
		if($statement->execute()){
			return true;
		}else{
			return false;	
		}
	}

	public function modificar(){
		$sql = "UPDATE usuario SET nombre = :nombre, edad = :edad, telefono = :telefono, correo = :correo WHERE id = :id";
		$statement = $this->conn->prepare($sql);
		$statement->bindParam(':nombre', $this->nombre);
		$statement->bindParam(':edad', $this->edad);
		$statement->bindParam(':telefono', $this->telefono);
		$statement->bindParam(':correo', $this->correo);
		$statement->bindParam(':id',$this->id);
		if($statement->execute()){
			return true;
		}else{
			return false;
		}
	}

	function __destruct(){
		$this->conn = null;
		$this->result = null;
	}
}


?>