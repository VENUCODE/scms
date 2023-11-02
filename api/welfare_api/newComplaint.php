<?php
session_start();

if (isset($_SESSION['sid']) && $_SESSION['usermode'] == 'STUDENT') {
    include("../connection.php");
    if ($conn) {
        if (isset($_POST['complaintDetails'])) {
            $compType = $_POST['complaintType'];
            $complaint = $_POST['complaintDetails'];
            $id = $_SESSION['sid'];

            $sql = "INSERT INTO COMPLAINTS (CTYPE, DESCRIPTION, RAISED_ID, RAISED_ON) VALUES ('$compType', '$complaint', '$id', DATE_ADD(NOW(), INTERVAL 330 MINUTE))";
            $result = mysqli_query($conn, $sql);
            // echo mysqli_error($conn);
            if ($result) {

                $response = array(
                    'status' => 'true',
                    'icon' => 'success',
                    'text' => 'Complaint Raised'
                );
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'false',
                    'icon' => 'error',
                    'text' => 'Could not register'
                );
                echo json_encode($response);
            }
        }
    } else {
        $response = array(
            'status' => 'false',
            'icon' => 'error',
            'text' => 'server connection failed'
        );
        echo json_encode($response);
    }
} else {
    header('Location: ../logout.php');
}
?>
