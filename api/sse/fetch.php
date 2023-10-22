<?php
error_reporting(0);
//making the api suitable for sse
header('Cache-Control:no-store');
header("Content-Type:text/event-stream");
include("connection.php");
$p='';
if($conn){
    while(TRUE){
    $result=mysqli_query($conn,"select * from O19_CE limit 10");
    $data=array();
    if($result){
        $data=json_encode(mysqli_fetch_all($result,MYSQLI_ASSOC));
    }
    if(strcmp($p,$data)!==0){
        $p=$data;
        echo "data:".$data."\n\n";
    }
    ob_end_flush();
    flush();
    sleep(1);
}
}
?>