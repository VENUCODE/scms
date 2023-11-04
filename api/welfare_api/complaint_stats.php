<?php
session_start();
error_reporting(0);
header('Cache-Control: no-store');
header('Content-Type: text/event-stream');
header('Connection: keep-alive');
include("../connection.php");

if (isset($_SESSION['wfid']) && $conn) {
    session_write_close();
    $p = '';
    while(true) {
        $sql = "SELECT SUM(CASE WHEN CONFIRMATION_STATUS = 'TRUE' THEN 1 ELSE 0 END) AS SOLVED, SUM(CASE WHEN CONFIRMATION_STATUS = 'FALSE' AND REPORT_STATUS = 'TRUE' AND RESPONSE_STATUS = 'FALSE' THEN 1 ELSE 0 END) AS REPORTED, SUM(CASE WHEN CONFIRMATION_STATUS = 'FALSE' AND REPORT_STATUS = 'FALSE' AND RESPONSE_STATUS = 'FALSE' THEN 1 ELSE 0 END) AS PENDING FROM COMPLAINTS;";
            
        $result = mysqli_query($conn, $sql);
        $data = array();    
        
        if ($result) {
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        
        $newData = json_encode($data);
        
        if ($newData !== $p) {
            $p = $newData;
            echo "data: $newData\n\n";
            ob_flush();
            flush();
        }
        
        sleep(1); 
    }
}
?>
