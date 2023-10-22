<?php
include("../connection.php");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$id_number=$_POST['id_number'];
$result=mysqli_query($conn,"DELETE from O19_CE WHERE ID_NUMBER='{$id_number}'");
if($result){
    echo "Deleted SuccessFully";
}
else{
    echo "Error:".mysqli_error($conn);
}
?>
