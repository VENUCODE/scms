<?php
session_start();
if(!(isset($_SESSION['usermode']))){
    header('Loaction:../logout.php');
    exit;
}
include("../connection.php");
$data=array();
if($conn && isset($_POST['cid']) && isset($_SESSION['sid'])){
    $CID=$_POST['cid'];
    $SID=$_SESSION['sid'];
    $sql="UPDATE COMPLAINTS SET CONFIRMATION_STATUS='TRUE',SOLVED_ON=now() WHERE CID='{$CID}' and RAISED_ID='{$SID}' and SOLVED_ON IS NOT NULL";
    $result=mysqli_query($conn,$sql);
    if ($result) {
        $response = array(
            'status' => 'true',
            'icon' => 'success',
            'text' => 'Complaint SOLVED'
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'false',
            'icon' => 'error',
            'text' => "couldn't update"
        );
        echo json_encode($response);
    }
}else{
    $response = array(
        'status' => 'false',
        'icon' => 'error',
        'text' => "SERVER DISCONNECTED"
    );
    echo json_encode($response);
}
?>