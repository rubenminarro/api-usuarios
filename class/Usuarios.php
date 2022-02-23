<?php

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

  class Usuarios{
        
		//conexión
		private $conn;
		
		//tabla
		private $db_table = "Usuarios";
		
		//columnas
		public $id;
		public $nombre;
		public $apellido;
		public $email;
		public $password;

		//db conexión
		public function __construct($db){
			$this->conn = $db;
		}
		
		// obtener todos los usuarios
		/*public function getUsuarios(){
			$sqlQuery = "SELECT id, nombre, email, designacion, fecha_creacion FROM " .$this->db_table. "";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			return $stmt;
		}
		
		//obtener Usuario
		public function getUsuario(){
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

		*/
    
		//crear Usuario
		public function createUsuario(){
			
			$sqlQuery = "INSERT INTO ".$this->db_table. " SET nombre = :nombre, apellido = :apellido, email = :email, password = :password, fecha_creacion = :fecha_creacion";

			$stmt = $this->conn->prepare($sqlQuery);

			$this->nombre=htmlspecialchars(strip_tags($this->nombre));
			$this->apellido=htmlspecialchars(strip_tags($this->apellido));
			$this->email=htmlspecialchars(strip_tags($this->email));
			$this->password=htmlspecialchars(strip_tags($this->password));
			$this->fecha_creacion=htmlspecialchars(strip_tags($this->fecha_creacion));
			
			$stmt->bindParam(':nombre', $this->nombre);
			$stmt->bindParam(':apellido', $this->apellido);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(":fecha_creacion", $this->fecha_creacion);

			$password_hash = password_hash($this->password, PASSWORD_BCRYPT);
			$stmt->bindParam(':password', $password_hash);

			if($stmt->execute()){
				return true;
			}
			
			return false;

		}

		public function emailExists(){
			
			$sqlQuery = "SELECT id, nombre, apellido, password FROM " .$this->db_table. " WHERE email = ? LIMIT 0,1";

			$stmt = $this->conn->prepare($sqlQuery);

			$this->email=htmlspecialchars(strip_tags($this->email));

			$stmt->bindParam(1, $this->email);
			
			$stmt->execute();

			$num = $stmt->rowCount();

			if($num>0){
				
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				$this->id = $row['id'];
				$this->nombre = $row['nombre'];
				$this->apellido = $row['apellido'];
				$this->password = $row['password'];

				return true;
			}

			return false;
		}
    
		//actualizar Usuario
		public function updateUsuario(){
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
    
		//borrar Usuario
		function deleteUsuario(){
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