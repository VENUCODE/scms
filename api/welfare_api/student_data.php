<?php
session_start();
header('Cache-Control: no-cache');
header('Content-Type: text/event-stream');
header('Connection: keep-alive');
include("../connection.php");

if (isset($_SESSION['sid']) && $conn) {
    session_write_close();
    $p = '';

    while (true) {
        $sql = "SELECT S.SID, S.SNAME, S.DORM, S.BRANCH, S.SPHONE, COUNT(C.RAISED_ID) AS TOTAL_COMPLAINTS, SUM(CASE WHEN (C.RESPONSE_STATUS = 'TRUE' AND C.CONFIRMATION_STATUS = 'TRUE') THEN 1 ELSE 0 END) AS SOLVED_COMPLAINTS FROM student_details S LEFT JOIN COMPLAINTS C ON S.SID = C.RAISED_ID WHERE S.SID = '{$_SESSION['sid']}' GROUP BY S.SID, S.SNAME, S.DORM, S.BRANCH";
        $result = mysqli_query($conn, $sql);
        $data = array();

        if ($result) {
            $data = mysqli_fetch_assoc($result);
        }

        // Set session variables with the data
        $_SESSION['dorm'] = $data['DORM'];
        $_SESSION['phone'] = $data['SPHONE'];

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
