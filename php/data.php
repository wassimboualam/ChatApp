<?php
    $i = 0;
    while ($row = mysqli_fetch_assoc($sql)) {
        // find last message sent by either user
        $query2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $sql2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
        $row2 = mysqli_fetch_assoc($sql2);
        if (mysqli_num_rows( $sql2 ) > 0) {
            $result = $row2["msg"];
            // trim message if bigger than 28
            strlen($result)>28? $msg = substr($result,0,28)."..." : $msg = $result;
            // add "You: " in last message when current user is sender
            $outgoing_id==$row2["outgoing_msg_id"]? $msg = "You: ".$msg:"";
        } else {
            $result = "No message available";
        }

        // check if user is online or offline
        ($row["status"] == "Offline now") ? $offline = "offline": $offline = "";
        
        $output .= '<a href="./chat.php?user_id='.$row["unique_id"].'">
                        <div class="content">
                            <img src="php/images/'.$row["img"].'" alt="">
                            <div class="details">
                                <span>'.$row["fname"]." ".$row["lname"].'</span>
                                <p>'.$msg.'</p>
                            </div>
                        </div>
                        <div class="status-dot '.$offline.'">
                            <i class="fas fa-circle"></i>
                        </div>
                    </a>';
    }
?>