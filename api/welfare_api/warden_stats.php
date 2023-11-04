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
        $sql = "SELECT wd.WID, COALESCE(SUM(CASE WHEN c.CONFIRMATION_STATUS = 'true' THEN 1 ELSE 0 END), 0) AS SolvedComplaintsCount
        FROM warden_details wd
        LEFT JOIN COMPLAINTS c ON wd.WID = c.SOLVED_BY
        GROUP BY wd.WID";
            
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
