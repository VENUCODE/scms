<?php
session_start();
include "connection.php";

$output = '';

if ($conn) {
    // echo "connection success";
      $email = $_POST['email'];
    $pass = $_POST['password'];
    $mode = $_POST['usermode'];
    $sql = '';
    switch ($mode) {
        case 'WARDEN':
            $sql .= "SELECT * FROM warden_login where WMAIL='{$email}' and WPASS='{$pass}'";
            break;
        case 'STUDENT':
            $sql .= "SELECT * FROM student_login where student_email='{$email}' and student_password='{$pass}'";
            break;
        case 'STUDENT WELFARE':
            $sql .= "SELECT * FROM welfare_login where WMAIL='{$email}' and WPASS='{$pass}'";
            break;
    }
    
    if ($sql !== '') {
        
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['usermode'] = $mode;

            switch ($mode) {
                case 'WARDEN':
                    $_SESSION['warden_mail'] = $email;
                    $_SESSION['wid'] = substr($email, 0, 4);
                    $_SESSION[$_SESSION['wid'] . '-login_time'] = time(); 
                    echo json_encode(['redirect' => './wardenPages/']);
                    break;
                case 'STUDENT':
                    $_SESSION['student_mail'] = $email;
                    $_SESSION['sid'] = substr($email, 0, 7);
                    $_SESSION[$_SESSION['sid'] . '-login_time'] = time(); 
                    echo json_encode(['redirect' => './studentPages/']);
                    break;
                case 'STUDENT WELFARE':
                    $_SESSION['welfare_mail'] = $email;
                    $_SESSION['wfid'] = substr($email, 0, 5);
                    $_SESSION[$_SESSION['wfid'] . '-login_time'] = time(); 
                    echo json_encode(['redirect' => './welfarePages/']);
                    break;
                default:
                    echo json_encode(['error' => 'Invalid Details']);
                    break;
            }
         
        } else {
            echo 'Invalid Details' . mysqli_error($conn);
            exit;
        }
    }
} else {
    echo 'Connection Failed' . mysqli_connect_error();
    exit;
}
?>
