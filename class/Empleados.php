<?php
  class Empleados{
        
		//conexión
		private $conn;
		
		//tabla
		private $db_table = "Empleados";
		
		//columnas
		public $id;
		public $nombre;
		public $email;
		public $designacion;
		public $fecha_creacion;

		//db conexión
		public function __construct($db){
			$this->conn = $db;
		}
		
		// obtener todos los empleados
		public function getEmpleados(){
			$sqlQuery = "SELECT id, nombre, email, designacion, fecha_creacion FROM " .$this->db_table. "";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
    
		//crear empleado
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
    
		//obtener empleado
		public function getEmpleado(){
			$sqlQuery = "SELECT id, nombre, email, designacion, fecha_creacion FROM ".$this->db_table." WHERE id = ? LIMIT 0,1";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bindParam(1, $this->id);
			$stmt->execute();
			$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$this->nombre = $dataRow['nombre'];
			$this->email = $dataRow['email'];
			$this->designacion = $dataRow['designacion'];
			$this->fecha_creacion = $dataRow['fecha_creacion'];
		}        
    
		
		//actualizar empleado
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
    
		//borrar empleado
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