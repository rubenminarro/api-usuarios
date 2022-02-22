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
	$empleado->id = isset($_GET['id']) ? $_GET['id'] : die();

	$empleado->getEmpleado();
	
	if($empleado->nombre != null){
		
		$emp_arr = array(
				"id" =>  $empleado->id,
				"nombre" => $empleado->nombre,
				"email" => $empleado->email,
				"designacion" => $empleado->designacion,
				"fecha_creacion" => $empleado->fecha_creacion
		);

		http_response_code(200);
		echo json_encode($emp_arr);
	}else{
		http_response_code(404);
    echo json_encode("Empleado no encontrado.");
  }
?>