<?php
session_start();
if (!isset($_SESSION['usermode'])) {
    header('Location: ../logout.php'); // Fixed "Location" typo
    exit;
}
include("../connection.php");
$data = array();
if ($conn && isset($_SESSION['wid']) ) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $dorm = $_POST['shift'];
    $WID = $_SESSION['wid'];

    $sql = "UPDATE warden_details SET WNAME='{$name}', WPHONE='$phone', WSHIFT='$dorm' WHERE WID='$WID'";
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
