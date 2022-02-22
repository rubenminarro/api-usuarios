<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once '../config/Database.php';
	include_once '../class/Empleados.php';
	
	$database = new Database();
	$db = $database->obtenerConexion();
	$empleado = new Empleados($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	if(!empty($data->id) && !empty($data->nombre) && !empty($data->email) && !empty($data->designacion)){ 
		
		$empleado->id = $data->id;
		$empleado->nombre = $data->nombre;
		$empleado->email = $data->email;
		$empleado->designacion = $data->designacion;
		$empleado->fecha_creacion = date('Y-m-d H:i:s');
		
		if($empleado->updateEmpleado()){
			http_response_code(201);         
			echo json_encode(array("mensaje" => "El empleado se ha actualizado correctamente."));
		}else{         
			http_response_code(503);        
			echo json_encode(array("mensaje" => "No se pudo actualizar el empleado."));
		}

	}else{
		http_response_code(400);    
		echo json_encode(array("mensaje" => "No se pudo actualizar el empleado. Datos incompletos."));
	}
?>