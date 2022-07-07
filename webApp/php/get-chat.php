<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once 'config.php';
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incomming_id = mysqli_real_escape_string($conn, $_POST['incomming_id']);

    // getting the image of incomming id
    $sql2 = "SELECT * FROM users WHERE unique_id = {$incomming_id}";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);


    $output = '';
    $sql = "SELECT * FROM messages 
                LEFT JOIN users ON users.unique_id = messages.incomming_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incomming_msg_id = {$incomming_id})
                OR (outgoing_msg_id = {$incomming_id} AND incomming_msg_id = {$outgoing_id}) ORDER BY msg_id";

    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) { // this is sender
                $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>' . $row['msg'] . '</p>
                                    </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming">
                                    <img src="php/image/'.$row2['image'].'" alt="">
                                    <div class="details">
                                        <p>' . $row['msg'] . '</p>
                                    </div>
                                </div>';
            }
        }
        echo $output;
    }
} else {
    header('../login.php');
}
