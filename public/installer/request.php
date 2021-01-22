<?php
require_once('../../vendor/autoload.php');
//require_once('../index.php');
//$output_is = exec('composer install');
//echo 'out put is '.$output_is;

require_once('env_editor.php');

$action = isset($_GET['action'])?$_GET['action']:'';

switch($action){
    case 'validate':
        $return = validateInputs();
        moveIcons();
        if(!empty($return)){
//            print_r($return);
            die(json_response(400, array('data' => $return)));
        }

        $connection_output = checkDBConnection();
        if($connection_output !== true){
//            die($connection_output);
//            die(json_response(400, array('data' => ['asdfadsf' => 'adfadf'])));
            die(json_response(400, array('data' => $connection_output)));
        }

        break;
    case 'install':
        $message = createEnv();
        if($message !== true){
            die(json_response(400, array('data' => $message)));
        }
        sleep(1);
        installComposer();
        createAdminAccount();
        updateTerms();
        sleep(2);
        moveIcons();
        $return = validateInputs();
        if(!empty($return)){
            echo json_response(400, array('data' => $return));
        }
        break;
    default:

        break;
}
