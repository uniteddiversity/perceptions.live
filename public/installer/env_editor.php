<?php
error_reporting(1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
if(isset($_POST['submit_all'])){
    print_r($_POST);
    die();
}

function moveIcons(){
    $target_dir = "./../assets/frontend/images/";
    $logo = $target_dir . 'live-perceptions-shared-logo.png';
    $logo_small = $target_dir . 'live-perceptions-logo.png';
    $uploadOk_logo = 1;
    $uploadOk_logo_small = 1;

    $name_logo = $_FILES["site_logo"]["name"];
    $ext_logo = pathinfo($name_logo, PATHINFO_EXTENSION);

    $name_logo_small = $_FILES["site_logo"]["name"];
    $ext_logo_small = pathinfo($name_logo_small, PATHINFO_EXTENSION);

    if($ext_logo && !(in_array($name_logo, ['png', 'jpg', 'jpeg']))){
        //extension not supported
        $uploadOk_logo = 0;
    }

    if($ext_logo_small && !(in_array($ext_logo_small, ['png', 'jpg', 'jpeg']))){
        //extension not supported
        $uploadOk_logo_small = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if($uploadOk_logo && isset($_FILES["site_logo"])){
        if (move_uploaded_file($_FILES["site_logo"]["tmp_name"], $logo)) {
//                echo "The envFile ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
//            echo "Sorry, there was an error uploading your envFile.";
        }
    }

    if($uploadOk_logo_small && isset($_FILES["site_logo_small"])){
        if (move_uploaded_file($_FILES["site_logo_small"]["tmp_name"], $logo_small)) {
//                echo "The envFile ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
//                die('SORRY');
//            echo "Sorry, there was an error uploading your envFile.";
        }
    }

}

function installComposer(){
    $result = shell_exec('COMPOSER_ALLOW_XDEBUG=1 /usr/bin/env php -d xdebug.remote_enable=0 -d xdebug.profiler_enable=0 -d xdebug.default_enable=0 composer.phar --version 2>&1');
    $output_is = shell_exec('composer install');

//    $output_is = shell_exec('php artisan migrate');
//    Artisan::call('migrate', array('--path' => 'app/migrations'));
    echo $output_is;
}

function createAdminAccount(){
    $dbhost = $_POST['db_host'];
    $dbuser = $_POST['db_user'];
    $dbpass = $_POST['db_password'];
    $dbname = $_POST['db_name'];
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
//    $pass = app('hash')->make('abc', []);
    $pass = password_hash($_POST['admin_password'], PASSWORD_DEFAULT);


    $sql = "INSERT INTO users (first_name, display_name, email, password, status_id, role_id, access_level_id)
            VALUES ('admin', 'admin', '".$_POST['admin_email']."', '".$pass."', '1', '1', '1')";
    $conn->query($sql);
    $conn->close();
}

function updateTerms(){
    $jsonString = file_get_contents('../../resources/lang/en.json');
    $data = json_decode($jsonString, true);
    $data_new = [];
    $data_new = $data;
    foreach ($data as $key => $entry) {
        if($key == 'video' && !empty($_POST['term_content'])){
            $data_new[$key] = $_POST['term_content'];
        }else{
            $data_new[$key] = $entry;
        }

        if($key == 'user' && !empty($_POST['term_user'])){
            $data_new[$key] = $_POST['term_user'];
        }else{
            $data_new[$key] = $entry;
        }
//dd($_POST['term_group']);
        if($key == 'group' && !empty($_POST['term_group'])){
            $data_new[$key] = $_POST['term_group'];
        }else{
            $data_new[$key] = $entry;
        }
    }

    $newJsonString = json_encode($data_new, JSON_PRETTY_PRINT);
    file_put_contents('../../resources/lang/en.json', $newJsonString);
//    $data[0]['activity_name'] = "TENNIS";
}

function validateInputs(){
    $errors = [];
    if(!isset($_POST['app_name']) || empty($_POST['app_name'])){
        $errors['app_name'] = 'App name cannot be null';
    }

    if(!isset($_POST['app_url']) || empty($_POST['app_url'])){
        $errors['app_url'] = 'App URL cannot be null';
    }

    if(!isset($_POST['db_host']) || empty($_POST['db_host'])){
        $errors['db_host'] = 'DB host cannot be null';
    }

    if(!isset($_POST['db_name']) || empty($_POST['db_name'])){
        $errors['db_name'] = 'DB name cannot be null';
    }

    if(!isset($_POST['db_user']) || empty($_POST['db_user'])){
        $errors['db_user'] = 'DB user cannot be null';
    }

    if(!isset($_POST['admin_email']) || empty($_POST['admin_email'])){
        $errors['admin_email'] = 'Admin account email cannot be empty';
    }

    if(!isset($_POST['admin_password']) || empty($_POST['admin_password'])){
        $errors['admin_password'] = 'Admin account password cannot be empty';
    }

    if(!isset($_POST['admin_password_confirm']) || (($_POST['admin_password_confirm'] != $_POST['admin_password']) )){
        $errors['admin_password_confirm'] = 'Admin confirm password not match!';
    }

    return $errors;
}

function createEnv(){
    $app_name = isset($_POST['app_name'])?$_POST['app_name']:'';
    $app_url = isset($_POST['app_url'])?$_POST['app_url']:'';

    $db_host = isset($_POST['db_host'])?$_POST['db_host']:'';
    $db_name = isset($_POST['db_name'])?$_POST['db_name']:'';
    $db_user = isset($_POST['db_user'])?$_POST['db_user']:'';
    $db_password = isset($_POST['db_password'])?$_POST['db_password']:'';
    $db_port = isset($_POST['db_port'])?$_POST['db_port']:'';

    $google_recaptcha_key = isset($_POST['google_recaptcha_key'])?$_POST['google_recaptcha_key']:'';
    $google_recaptcha_secret = isset($_POST['google_recaptcha_secret'])?$_POST['google_recaptcha_secret']:'';

    $outgoing_email_address = isset($_POST['outgoing_email_address'])?$_POST['outgoing_email_address']:'';
    $outgoing_email_name = isset($_POST['outgoing_email_name'])?$_POST['outgoing_email_name']:'';
    $privacy_policy_external_url = isset($_POST['privacy_policy_external_url'])?$_POST['privacy_policy_external_url']:'';

    $admin_name = isset($_POST['admin_name'])?$_POST['admin_name']:'';
    $admin_email = isset($_POST['admin_email'])?$_POST['admin_email']:'';

    $app_mission = isset($_POST['app_mission'])?$_POST['app_mission']:'';
    $app_mission_description = isset($_POST['app_mission_description'])?$_POST['app_mission_description']:'';
    $guide_line_url = isset($_POST['guide_line_url'])?$_POST['guide_line_url']:'';
    $terms_of_service = isset($_POST['terms_of_service'])?$_POST['terms_of_service']:'';
    $feedback = isset($_POST['feedback'])?$_POST['feedback']:'';
    $app_credit = isset($_POST['app_credit'])?$_POST['app_credit']:'';
    $app_key = 'base64:'.base64_encode(generateRandomString(32));
    $env_data =
        "APP_NAME='$app_name'
APP_ENV=local
APP_KEY=$app_key
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=$app_url

DB_CONNECTION=mysql
DB_HOST=$db_host
DB_PORT=$db_port
DB_DATABASE=$db_name
DB_USERNAME=$db_user
DB_PASSWORD=$db_password

BROADCAST_DRIVER=log
CACHE_DRIVER=envFile
SESSION_DRIVER=envFile
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=log
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
AUTO_GENERATED_EMAIL_DOMAIN=perceptions.live
APP_DOMAIN=http://prcptions2.lk

PAYPAL_MODE=sandbox

GOOGLE_RECAPTCHA_KEY=$google_recaptcha_key
GOOGLE_RECAPTCHA_SECRET=$google_recaptcha_secret

ADMIN_NAME=$admin_name
ADMIN_MAIL=$admin_email
MAIL_FROM_ADDRESS=$outgoing_email_address
MAIL_FROM_NAME=$outgoing_email_name

PRIVACY_POLICY='$privacy_policy_external_url'

APP_MISSION='$app_mission'
APP_MISSION_DESCRIPTION='$app_mission_description'
GUIDE_LINE_URL='$guide_line_url'
TERMS_OF_SERVICE='$terms_of_service'
FEEDBACK='$feedback'
APP_CREDIT='$app_credit'";



error_reporting(1);
error_reporting(E_ALL);
ini_set('display_errors', '1');





$file = 'env.backup_new';
file_put_contents($file, $env_data, FILE_APPEND | LOCK_EX);


    //$envFile = fopen("./env.backup", "w");
    //fwrite($envFile, $env_data);
    //fclose($envFile);
    $envFile = 'env.txt"';
    $newFile = '../../.env';

    $output = copy($file, $newFile);
    die('out is '.$output); artisan 

    
    try{
        if (!copy($envFile, $newFile)) {
            $errors['error'] = 'Error in envFile creation';
            return $errors;
        }
    }catch(Exception $e){
echo ('Error '.$e->getMessage());
    }
    

    return true;
}

function json_response($code = 200, $message = null)
{
    // clear the old headers
    header_remove();
    // set the actual code
    http_response_code($code);
    // set the header to make sure cache is forced
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    // treat this as json
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
    );
    // ok, validation error, or failure
    header('Status: '.$status[$code]);
    // return the encoded json
    return json_encode(array(
        'status' => $code < 300, // success or not?
        'message' => $message
    ));
}

function checkDBConnection()
{
    $dbhost = $_POST['db_host'];
    $dbuser = $_POST['db_user'];
    $dbpass = $_POST['db_password'];
    $dbname = $_POST['db_name'];

    try
    {
        if ($db = mysqli_connect($dbhost, $dbuser, $dbpass))
        {
            $db_status = true;
        }
        else
        {
            $errors['error'] = 'Server connection error';
            return $errors;
        }
    }
    catch(Exception $e)
    {
        $errors['error'] = 'Server error';
        return $errors;
    }

    if($db_status){
        if (mysqli_select_db($db, $dbname)){
            return true;
        }else{
            $errors['error'] = 'Server connection Ok. Db connection error!';
            return $errors;
        }
    }else{
        $errors['error'] = 'Server error';
        return $errors;
    }

    return true;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}