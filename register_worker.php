<?php
error_reporting(0);
header("Access-Control-Allow-Origin: *"); // running as crome app

if (!isset($_POST)) {
	$response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die;
}

include_once("dbconnect.php");

$name = $_POST['name'];
$email = $_POST['email'];
$password = sha1($_POST['password']);
$phone = $_POST['phone'];
$address = $_POST['address'];

$sqlinsert="INSERT INTO `tbl_workers`(`worker_name`, `worker_email`, `worker_password`, `worker_phone`, `worker_address`) VALUES ('$name','$email','$password','$phone','$address')";

try{
    if ($conn->query($sqlinsert) === TRUE) {
        $response = array('status' => 'success', 'data' => null);
        sendJsonResponse($response);
    } else {
        $response = array('status' => 'failed', 'data' => null);
        sendJsonResponse($response);
    }   
}catch (Exception $e) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die;
}
	

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>
