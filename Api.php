<?php
require_once 'Conexion.php';
require_once 'Clases/Estados.php';
require_once 'Clases/Patrimonios.php';

//función validando todos los parametros disponibles
//pasaremos los parámetros requeridos a esta función
function verificadoDeParametros($params){
	//suponiendo que todos los parametros estan disponibles
	$available = true;
	$missingparams = "";

	foreach ($params as $param) {
		if(!isset($_POST[$param]) || strlen($_POST[$param]) <= 0){
			$available = false;
			$missingparams = $missingparams . ", " . $param;
		}
	}

	//si faltan parametros
	if(!$available){
		$response = array();
		$response['error'] = true;
		$response['message'] = 'Parametro' . substr($missingparams, 1, strlen($missingparams)) . ' vacio';

		//error de visualización
		echo json_encode($response);

		//detener la ejecición adicional
		die();
	}
}

//una matriz para mostrar las respuestas de nuestro api
$response = array();

//si se trata de una llamada api
//que significa que un parametro get llamado se establece un la URL
//y con estos parametros estamos concluyendo que es una llamada api

if(isset($_GET['apicall'])){
	//Aqui iran todos los llamados de nuestra api
	switch ($_GET['apicall']) {              
                //*********************************************************************************
                //OPERACIONES ESTADOS
		case 'listarEstados':
			$db = new Estados();
			$lista = $db->listar();
			$response['error'] = false;
			$response['message'] = 'solicitud completada correctamente';
			$response['contenido'] = $lista; 
		break;
                
                case 'guardarEstado':

                            //primero haremos la verificación de parametros.

                            verificadoDeParametros(array('idestado', 'nombreestado'));
                            $db = new Estados();
                            $result = $db->guardar($_POST['idestado'],$_POST['nombreestado']);

                            if($result){

                                    //esto significa que no hay ningun error
                                    $response['error'] = false;
                                    //mensaje que se ejecuto correctamente
                                    $response['message'] = 'Estado guardado correctamente';

                                    $response['contenido'] = $db->listar();
                            }else{
                                    $response['error'] = true;
                                    $response['message'] = 'ocurrio un error, intenta nuevamente';
                            }
                    break;

                case 'editarEstado':

			//primero haremos la verificación de parametros.
			verificadoDeParametros(array('idestado', 'nombreestado'));

			$db = new Estados();
			$result = $db->editar($_POST['idestado'],$_POST['nombreestado']);

			if($result){

				//esto significa que no hay ningun error
				$response['error'] = false;
				//mensaje que se ejecuto correctamente
				$response['message'] = 'Estado editado correctamente';
				$response['contenido'] = $db->listar();
			}else{
				$response['error'] = true;
				$response['message'] = 'ocurrio un error, intenta nuevamente';
			}

		break;

                case 'eliminarEstado':
                    if(isset($_POST['idestado']) && !empty($_POST['idestado'])){
                            $db = new Estados();
                            if($db->eliminar($_POST['idestado'])){
                                    $response['error'] = false;
                                    $response['message'] = 'estado eliminado';
                                    $response['contenido'] = $db->listar();
                            }else{
                                    $response['error'] = true;
                                    $response['message'] = 'el estado no fue eliminado';
                            }
                    }

                    break;
                //*********************************************************************************
                //OPERACIONES PATRIMONIOS
                case 'patrimoniosCategoria':                    
                    verificadoDeParametros(array('lucategoria'));
                            $db = new Patrimonios();
                            $lista = $db->listarPorCategoria($_POST['lucategoria']); 
                            $response['error'] = false;
                            $response['message'] = 'solicitud completada correctamente';
                            $response['contenido'] = $lista; 
		break;
        }
}else{
	//si no es un api el que se esta invocando
	//empujar los valores apropiados en la estructura json
	$response['error'] = true;
	$response['message'] = 'No se llamo a Apicall';
}
echo json_encode($response);
?>