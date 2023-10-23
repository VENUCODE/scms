<?php
session_start();
if(!(isset($_SESSION['usermode']))){
    header('Loaction:../logout.php');
    exit;
}
include("../connection.php");
$data=array();
if($conn && isset($_POST['complaintId'])){
    $CID=$_POST['complaintId'];
    $sql="SELECT `CID`, `DESCRIPTION`, `CTYPE`, `RAISED_ID`, `RAISED_ON`, `RESPONSE_STATUS`, `REPORT_STATUS`, `CONFIRMATION_STATUS`, `SOLVED_BY` FROM `COMPLAINTS` WHERE CID='{$CID}'";
    $result=mysqli_query($conn,$sql);
    if($result){
        $data=mysqli_fetch_assoc($result);
        $data['status']=TRUE;
        echo json_encode($data);
    }else{
        $data['status']=FALSE;
        $data['message']='Could not fetch data';
        echo json_encode($data);
    }
}else{
    echo json_encode(array(["status"=>FALSE,'message'=>"No input or connection lost"]));
}
?>