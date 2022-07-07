<?php
$conn = mysqli_connect('localhost', 'root', '', 'chat');
if(!$conn){
    echo('not connected').mysqli_connect_error();
}
?>

