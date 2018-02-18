<?php 
/**
* @author Santos Osmin Urrutia 
*/
require_once('Connector.php');
class Usuario{
	//Se declaran los atributos de la clase
	private $id;
	private $nombre;
	private $edad;
	private $telefono;
	private $correo;
	//Lo utilizaremos para guardar los resultado de una busqueda
	private $result = null;
	//Se guarda la coneccion en esta variable
	private $conn = null;

	//Para no instanciar tanto la clase de conexion lo haremos en el constructor
	//los parametros los definimos como null para que no sea obligacion pasarle datos
	function __construct($id=null,$nombre=null,$edad=null,$telefono=null,$correo=null){
		//Instanciamos la clase de conexion
		$model = new Connector();
		//Le asignamos la coneccion a la variable mediante un metodo de la case de conexion
		$this->conn = $model->getConexion();
		//Si el contructor resive algun parametro se le asigna el valor al atributo correspondiente
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

	//Para poder usar este metodo, anteriormente tenemos que pasar todos los datos por medio de los metodos setter
	public function guardar(){
		//Se crea la sentencia sql dejandole indicado que se le pasaran parametros luego, ejemplo ":nombre"
		$sql = "INSERT INTO usuario (nombre, edad, telefono, correo) VALUES (:nombre, :edad, :telefono, :correo)";
		//Se prepara la conexion para que reciba la sentencia sql
		$statement = $this->conn->prepare($sql);
		//Una ves preparada, solamente le pasamos los parametros con la funcion bindParam
		$statement->bindParam(':nombre', $this->nombre);
		$statement->bindParam(':edad', $this->edad);
		$statement->bindParam(':telefono', $this->telefono);
		$statement->bindParam(':correo', $this->correo);
		//Comprobamos si no hay problemas
		//sino los hay retornamos true indicando que todo salio bien 
		if($statement->execute()){
			return true;
		}else{
			return false;			
		}
	}
	
	//Para usar esta funcion solo tenemos que settear el valor del id 
	public function buscarPorId(){
		////Se crea la sentencia sql dejandole indicado que se le pasaran parametros luego, ejemplo ":id"
		$sql = "SELECT  nombre, edad, telefono, correo FROM usuario WHERE id = :id";
		$statement = $this->conn->prepare($sql);
		$statement->bindParam(':id',$this->id);
		//Se ejecuta la sentencia
		$statement->execute();
		//con la funcion fetch lo que hacemos es que en una variable guardamos un arreglo que lo pordemos usar asi,ejemplo "$result['nombre']"
		$this->result = $statement->fetch();
		//Retornamos un objeto del tipo de la clase Usuario
		//Esto para poder hacer uso de los datos, sera de esta forma
		//$usuari->setId($id);
		//$resultado = $usuario->buscarPorId();
		//$resultado->getNombre():
		return new self($this->id,$this->result['nombre'],$this->result['edad'],$this->result['telefono'],$this->result['correo']);	
	}

	//Para usar este metodo solamente lo tenemos que llamar
	public function buscarTodo(){
		$sql = "SELECT id, nombre, edad, telefono, correo FROM usuario";
		$statement = $this->conn->prepare($sql);
		$statement->execute();
		$this->result = $statement->fetchAll();
		if ($this->result) {
			return $this->result;
		}
		//para poder usar los datos retornado tendremos que hacer uso de un foreach($result as $user){ $user['nombre']} 
	}

	//Solo se pasa el valor del id por medio de setId() y luego llamar la funcion 
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

	//Se les asignan los valores por medio de los setter y luego se llama la funcion 
	//retorna true si se ejecuta y false si hay alguna falla
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

	//En ese metodo igualamos a null los objetos que hemos utilizado, asi para que no consuman recursos
	function __destruct(){
		$this->conn = null;
		$this->result = null;
	}
}


?>