<?php
  
	class Empleados{
        
		private $conn;
		private $db_table = "Empleados";
		
		public $id;
		public $nombre;
		public $email;
		public $designacion;
		public $fecha_creacion;

		public function __construct($db){
			$this->conn = $db;
		}
		
		public function getEmpleados(){
			$sqlQuery = "SELECT id, nombre, email, designacion, fecha_creacion FROM " .$this->db_table. "";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
    
		public function createEmpleado(){
			
			$sqlQuery = "INSERT INTO ".$this->db_table." SET nombre = :nombre, email = :email, designacion = :designacion, fecha_creacion = :fecha_creacion";
		
			$stmt = $this->conn->prepare($sqlQuery);
		
			$this->nombre=htmlspecialchars(strip_tags($this->nombre));
			$this->email=htmlspecialchars(strip_tags($this->email));
			$this->designacion=htmlspecialchars(strip_tags($this->designacion));
			$this->fecha_creacion=htmlspecialchars(strip_tags($this->fecha_creacion));
		
			$stmt->bindParam(":nombre", $this->nombre);
			$stmt->bindParam(":email", $this->email);
			$stmt->bindParam(":designacion", $this->designacion);
			$stmt->bindParam(":fecha_creacion", $this->fecha_creacion);
		
			if($stmt->execute()){
				return true;
			}
			return false;
		}
    
		public function updateEmpleado(){
			$sqlQuery = "UPDATE ".$this->db_table." SET nombre = :nombre, email = :email, designacion = :designacion, fecha_creacion = :fecha_creacion WHERE id = :id";
			$stmt = $this->conn->prepare($sqlQuery);
	
			$this->id=htmlspecialchars(strip_tags($this->id));
			$this->nombre=htmlspecialchars(strip_tags($this->nombre));
			$this->email=htmlspecialchars(strip_tags($this->email));
			$this->designacion=htmlspecialchars(strip_tags($this->designacion));
			$this->fecha_creacion=htmlspecialchars(strip_tags($this->fecha_creacion));
			
			$stmt->bindParam(":id", $this->id);
			$stmt->bindParam(":nombre", $this->nombre);
			$stmt->bindParam(":email", $this->email);
			$stmt->bindParam(":designacion", $this->designacion);
			$stmt->bindParam(":fecha_creacion", $this->fecha_creacion);
			
			if($stmt->execute()){
				return true;
			}
			return false;
    }
    
		function deleteEmpleado(){
			$sqlQuery = "DELETE FROM ".$this->db_table. " WHERE id = ?";
			$stmt = $this->conn->prepare($sqlQuery);
	
			$this->id=htmlspecialchars(strip_tags($this->id));
	
			$stmt->bindParam(1, $this->id);
	
			if($stmt->execute()){
				return true;
			}
			return false;
		}
  }
?>