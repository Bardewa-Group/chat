<?php
while ($row = mysqli_fetch_assoc($sql)) {

    $sql2 = "SELECT * FROM messages WHERE (incomming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id ={$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id}
                OR outgoing_msg_id ={$row['unique_id']}) ORDER BY msg_id DESC LIMIT 1";

    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    if (mysqli_num_rows($query2) > 0) {
        $result = $row2['msg'];
    } else {
        $result = 'No message available';
    }

    (strlen($result) > 20) ? $msg = substr($result, 0, 20) . '...' : $msg = $result;
    // if (!empty($row2["outgoing_msg_id"])) {
    //     ($outgoing_id == $row2['outgoing_msg_id']) ? $you = 'You: ' : $you = '';
    // }else{
    //     $you = '';
    // }

    ($outgoing_id == $row2['outgoing_msg_id']) ? $you = 'You: ' : $you = '';
    ($row['status'] == 'Offline now') ? $offline = 'Offline' : $offline = ''; // check if user is ofline or not


    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                        <img src="php/image/' . $row['image'] . '" alt="">
                        <div class="details">
                            <span>' . $row['fname'] . ' ' . $row['lname'] . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                    </div>
                    <div class="status-dot">
                        <i class="fas fa-circle '.$offline.'"></i>
                    </div>
                </a>';
}
