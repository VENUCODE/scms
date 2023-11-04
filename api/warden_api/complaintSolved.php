<?php
session_start();
if(!(isset($_SESSION['usermode']))){
    header('Loaction:../logout.php');
    exit;
}
include("../connection.php");
echo(isset($_SESSION['wid']));
$data=array();

if($conn 
&& isset($_POST['cid'])
 && 
isset($_SESSION['wid'])
){
    $CID=$_POST['cid'];
    $WID=$_SESSION['wid'];
    $sql="UPDATE COMPLAINTS SET RESPONSE_STATUS='TRUE',SOLVED_ON=now(),SOLVED_BY='{$WID}' WHERE CID={$CID} AND CONFIRMATION_STATUS='FALSE'";
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