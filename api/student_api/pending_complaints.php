<?php
session_start();
include "../connection.php";
if($conn){
    $sql='select * from COMPLAINTS where RAISED_BY={`O190001`} and SOLVED_STATUS={`FALSE`} and REPORTED_STATUS={`FALSE`} AND CONFIRM_STATUS=`FALSE`';
    $result=mysqli_query($conn,$sql);
    if($result){
        print_r(json_encode(mysqli_fetch_all($result,MYSQLI_ASSOC)));
    }
}
else {
    echo "conncetion Failed";
}
?>