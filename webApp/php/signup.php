<?php
session_start();
include_once 'config.php';
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
    // now validating email first
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        // lets check email already exist in database or not
         $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
         if(mysqli_num_rows($sql) > 0){
            echo "$email- this email already exist";
         }else{
            // checking user upload file
            if(isset($_FILES['image'])){
                $img_name = $_FILES['image']['name']; // getting user uploaded image name
                // $img_type = $_FILES['image']['type']; // getting user uploaded image type
                $tmp_name = $_FILES['image']['tmp_name']; // this temporary name is used to save data
                
                // now its time to get the extension of image 
                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode); // we get the extension of image

                $img_extension = ['png', 'jpeg', 'jpg'];

                if(in_array($img_ext, $img_extension) === true){
                    $time = time();

                    // moving image to folder
                    $new_img_name = $time.$img_name;

                    if(move_uploaded_file($tmp_name, 'image/'.$new_img_name)){
                        $status = "Active now";
                        $random_id = rand(time(), 10000000); // creating random id for users

                        // lets include user data into table
                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, image, status) 
                        VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                        
                        // if inserted
                        if($sql2){
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if(mysqli_num_rows($sql3) > 0){
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id'];
                                $x = true;
                                echo "$x";
                            }
                        }else{
                            echo 'something went wrong';
                        }
                    }
 
                }else{
                    echo "please select an image of file type like png, jpeg or jpg";
                }
            }else{
                echo "please select an image";
            }
        }
    }else{
        echo "$email - this is not a valid email address";
    }
}else{
    echo 'All inputs are required !! from signup.php';
}
