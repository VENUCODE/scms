<?php
session_start();
error_reporting(0);
header('Cache-Control: no-store');
header('Content-Type: text/event-stream');
header('Connection: keep-alive');
include("../connection.php");

if (isset($_SESSION['wid']) && $conn) {
    session_write_close();
    $p = '';
    while (true) {
        $sql = "SELECT (@row_number := @row_number + 1) AS SNO, `CID`, `DESCRIPTION`, `CTYPE`, DATE_FORMAT(`SOLVED_ON`, '%d/%m/%y %h:%i %p') AS RESPONSE_DATE 
                FROM `COMPLAINTS`, (SELECT @row_number := 0) AS t 
                WHERE  `SOLVED_BY` = '" . $_SESSION['wid'] . "' AND RESPONSE_STATUS='TRUE' AND CONFIRMATION_STATUS='FALSE'
                ORDER BY `RESPONSE_DATE` DESC";

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
