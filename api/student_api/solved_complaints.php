<?php
session_start();
error_reporting(0);
header('Cache-Control: no-store');
header('Content-Type: text/event-stream');
header('Connection: keep-alive');
header('Access-Control-Allow-Origin: *'); 
include("../connection.php");

if (isset($_SESSION['sid']) && $conn) {
    session_write_close();
    $p = '';

    while (true) {
        $sql = "SELECT (@row_number := @row_number + 1) AS SNO, `CID`, `DESCRIPTION`, `CTYPE`, DATE_FORMAT(`RAISED_ON`, '%d/%m/%y %h:%i %p') AS RAISE_DATE 
            FROM `COMPLAINTS`, (SELECT @row_number := 0) AS t 
            WHERE  `RAISED_ID` = '" . $_SESSION['sid'] . "' AND   `RESPONSE_STATUS`='TRUE' AND `CONFIRMATION_STATUS`='TRUE'
            ORDER BY `RAISE_DATE` DESC";

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
