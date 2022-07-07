<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once 'config.php';
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incomming_id = mysqli_real_escape_string($conn, $_POST['incomming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incomming_msg_id, outgoing_msg_id, msg)
                                VALUES({$incomming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        header('../login.php');
    }
?>