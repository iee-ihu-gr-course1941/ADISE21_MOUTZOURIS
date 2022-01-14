<?php

session_start();

include('../db/db_connection.php');
include('./board_functions.php');
include('./lobby_functions.php');

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);
if($input==null) {
    $input=[];
}
if(isset($_SERVER['HTTP_X_TOKEN'])) {
    $input['token']=$_SERVER['HTTP_X_TOKEN'];
} else {
    $input['token']='';
}


switch ($r = array_shift($request)) {
    case 'board':
		switch ($b = array_shift($request)) {
			case 'getGameCards':
					$currentHand = getGameCards();
					echo json_encode(array('status' => '200'));
                
                    //echo json_encode(array('status' => '404'));
                
                break;
			default:
                header("HTTP/1.1 404 Not Found");
                break;
        }
		break;
	case 'lobby':
		$players = getLobby();
        $status = checkNumberOfPlayers();
		echo json_encode(array(
            'players' => $players,
            'status' => $status
        ));
        break;
	default:
		header("HTTP/1.1 404 Not Found");
		break;
}

?>