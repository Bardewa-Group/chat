<?php
session_start();
include_once 'config.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($email) && !empty($password)){
    // yes email and password receive now let's check its validity
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
    if(mysqli_num_rows($sql) > 0){
        // found data on database
        $row = mysqli_fetch_assoc($sql);
        $status = 'Active now';
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");


        $_SESSION['unique_id'] = $row['unique_id'];   // i am using this later after lunch
        $x = true;
        echo "$x";
    }
    else {
        echo "email or password is incorrect !";
    }
}else{
    echo 'All field are required !';
}
?>