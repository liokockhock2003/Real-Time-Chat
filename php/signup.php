<?php
    session_start();
   require_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    //check if email is valid or not
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //check if email already existed
            $query = "SELECT email FROM users WHERE email = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result)>0){
                echo "$email - already existed!";
            } else {
                //check user upload any file or not
                if(isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];

                    //explode image and get the last extension like jpg png
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);

                    $extension = ['png', 'jpeg', 'jpg'];
                    if(in_array($img_ext, $extension) === true){
                        $time = time(); // this time is need to rename the user file with current time in order to achieve uniqueness in name
                        $new_img_name = $time.$img_name;
                        
                        if(move_uploaded_file($tmp_name, "../images/".$new_img_name)){
                            $status = "Active now";
                            $random_id = rand(time(), 10000000);

                            $query1 = "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
                            $stmt1 = mysqli_prepare($conn, $query1);
                            mysqli_stmt_bind_param($stmt1, "sssssss", $random_id, $fname, $lname, $email, $password, $new_img_name, $status);
                            $execution_result = mysqli_stmt_execute($stmt1);
                            $affected_row = mysqli_stmt_affected_rows($stmt1);
                            
                            if($execution_result && $affected_row === 1){
                                $_SESSION['unique_id'] = $random_id;
                                echo "success";
                            } else {
                                echo "no rows inserted!";
                            }
                        }
                    } else{
                        echo "Please select an image file that is either jpg, jpeg or png!";
                    }

                } else{
                    echo "Please select an image file!";
                }
            }
        } else {
            echo "Invalid Email!";
        }
    } else {
        echo "All input field are required!";
    }


    // $sql1 = "SELECT email FROM user WHERE email=?";
    // $stmt1 = mysqli_prepare($conn, $sql1);
    // mysqli_stmt_bind_param($stmt1, "s", $email);
    // mysqli_stmt_execute($stmt1);
    // $result = mysqli_stmt_get_result($stmt1);