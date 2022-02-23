<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

   include_once '../config/Database.php';
   include_once '../class/Usuarios.php';

	$database = new Database();
  $db = $database->obtenerConexion();
  $usuario = new Usuarios($db);
	
	$data = json_decode(file_get_contents("php://input"));
 
	$usuario->nombre = $data->nombre;
	$usuario->apellido = $data->apellido;
	$usuario->email = $data->email;
	$usuario->password = $data->password;
	$usuario->fecha_creacion = date('Y-m-d H:i:s');

	if(!empty($usuario->nombre) && !empty($usuario->apellido) && !empty($usuario->email) && !empty($usuario->password)){
 
    if($usuario->createUsuario()){        
			http_response_code(201);         
			echo json_encode(array("mensaje" => "El usuario se ha creado correctamente."));
		}else{         
			http_response_code(503);        
			echo json_encode(array("mensaje" => "No se pudo crear el usuario."));
		}

	}else{
		http_response_code(400);    
		echo json_encode(array("mensaje" => "No se pudo crear el usuario. Datos incompletos."));
	}
?>