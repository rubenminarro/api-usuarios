<?php
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	include_once '../config/Database.php';
	include_once '../class/Empleados.php';
	
	$database = new Database();
	$db = $database->obtenerConexion();
	$empleados = new Empleados($db);
	$stmt = $empleados->getEmpleados();
	$empleadosCount = $stmt->rowCount();

	if($empleadosCount > 0){
			
		$empleadoArr = array();
		$empleadoArr["Empleados"] = array();
		$empleadoArr["empleadosCount"] = $empleadosCount;
			
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$e = array(
				"id" => $id,
				"nombre" => $nombre,
				"email" => $email,
				"designacion" => $designacion,
				"fecha_creacion" => $fecha_creacion
			);
			array_push($empleadoArr["Empleados"], $e);
		}
		http_response_code(200);
		echo json_encode($empleadoArr);
	}else{
		http_response_code(404);
		echo json_encode(
			array("mensaje" => "No se han encontrado datos.")
		);
	}
?>