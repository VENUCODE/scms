<?php
session_start();
if (!isset($_SESSION['usermode'])) {
    header('Location: ../logout.php'); // Fixed "Location" typo
    exit;
}
include("../connection.php");
$data = array();
if ($conn && isset($_SESSION['sid']) ) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $dorm = $_POST['dorm'];
    $SID = $_SESSION['sid'];

    $sql = "UPDATE student_details SET SNAME='{$name}', SPHONE='$phone', DORM='$dorm' WHERE SID='$SID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['phone'] = $phone;
        $_SESSION['dorm'] = $dorm;
        $_SESSION['sname'] = $name;
        $response = array(
            'status' => 'true',
            'icon' => 'success',
            'text' => 'Profile Updated'
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'false',
            'icon' => 'error',
            'text' => "Couldn't update"
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        'status' => 'false',
        'icon' => 'error',
        'text' => "Server disconnected"
    );
    echo json_encode($response);
}
?>
