<?php
$trimmed_msg = "";
while($rows = mysqli_fetch_assoc($result)){

    $query3 = "SELECT * FROM messages WHERE (incoming_id = ? AND outgoing_id = ?) OR (incoming_id = ? AND outgoing_id = ?) ORDER BY msg_id DESC LIMIT 1";
    $stmt3 = mysqli_prepare($conn, $query3);
    mysqli_stmt_bind_param($stmt3, "ssss", $rows['unique_id'], $outgoing_id, $outgoing_id, $rows['unique_id']);
    mysqli_stmt_execute($stmt3);
    $result3 = mysqli_stmt_get_result($stmt3);

    if(mysqli_num_rows($result3) > 0){
        $row3 = mysqli_fetch_assoc($result3);
        $msg = $row3['msg'];

        //trimmed the message if word more than 28 words
        (strlen($msg) > 28) ? $trimmed_msg = substr($msg, 0, 28).'...' : $trimmed_msg = $msg;
        
        //add you in front if the last message is yours
        ($outgoing_id == $row3["outgoing_id"]) ? $you = "You: ": $you = "";

    } else {
        $trimmed_msg = "";
    }
    //check user is online or offline
    ($rows['status'] == "Offline now") ? $offline = "offline" : $offline = "";
    

    if($_SESSION['unique_id'] != $rows['unique_id']){
        $output .= '<a href="chat.php?user_id='.$rows["unique_id"].'">
                <div class="content">
                    <img src="images/'.$rows['img'].'" alt="">
                    <div class="details">
                        <span>'.$rows['fname'].' '.$rows['lname'].'</span>
                        <p>' .$trimmed_msg. '</p>
                    </div>
                </div>

                <div class="status-dot '.$offline.'">
                    <i class="fa fa-circle"></i>
                </div>
            </a>';
    }
}