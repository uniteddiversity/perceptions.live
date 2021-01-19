<?php
// Turn off error reporting
error_reporting(0);


$dbname = $_POST['db'];
$dbuser = $_POST['user'];
$dbpass = $_POST['password'];
$dbhost = $_POST['host'];
$dbport = $_POST['port'];

$db_status = false;

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


try
{
    if ($db = mysqli_connect($dbhost, $dbuser, $dbpass))
    {
        $db_status = true;
    }
    else
    {
        die(json_response(500, 'Server connection error'));
    }
}
catch(Exception $e)
{
//    echo $e->getMessage();
    die(json_response(500, 'Server error'));
}

if (mysqli_select_db($db, $dbname)){
    die(json_response(200, 'Connection ok! Db ok!'));
}else{
    die(json_response(500, 'Server connection Ok. Db connection error!'));
}
die(json_response(200, 'Connection ok! Db ok!'));