<?php 
	/**
	* @author Santos Osmin Urrutia Iraheta
	*/
	class Connector{
		private $dns="mysql:host=localhost;dbname=pdo";
		private $user="root";
		private $pass="";
		private $conn = null;
		function __construct(){
			try{
				$this->conn = new PDO($this->dns,$this->user,$this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			}catch(PDOException $e){
				echo "Error= " . $e->getMessage();
			}
		}
		public function getConexion(){
			return $this->conn;
		}
		function __destruct(){
			$this->conn = null;
		}
	}

?>