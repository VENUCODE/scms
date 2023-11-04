<?php
session_start();
header('Cache-Control: no-cache');
header('Content-Type: text/event-stream');
header('Connection: keep-alive');
include("../connection.php");

if (isset($_SESSION['wid']) && $conn) {
    session_write_close();
    $p = '';

    while (true) {
        $sql = "SELECT WD.WID, WD.WNAME, WD.WPHONE, WD.WSHIFT, COALESCE(COUNT(C.CID), 0) AS SOLVED_COMPLAINTS
        FROM warden_details WD
        LEFT JOIN COMPLAINTS C ON WD.WID = C.SOLVED_BY
        WHERE WD.WID = '{$_SESSION['wid']}' AND C.CONFIRMATION_STATUS = 'TRUE' AND C.RESPONSE_STATUS = 'TRUE'
        GROUP BY WD.WID, WD.WNAME, WD.WPHONE, WD.WSHIFT;
        "; 

        $result = mysqli_query($conn, $sql);
        $data = array();

        if ($result) {
            $data = mysqli_fetch_assoc($result);
        }

        // Set session variables with the data
        $_SESSION['wdorm'] = $data['WNAME'];
        $_SESSION['wphone'] = $data['WPHONE']; 

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
