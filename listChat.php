<?php
    $con = mysqli_connect("localhost","db","pk","cimage");
    $cookie = $_COOKIE["Auth"];
    $query = "select * from users where cookie='$cookie';";
    $result = mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    $un = $row['username'];

    if(isset($_COOKIE["CHAT"])){
        $cookie2 = $_COOKIE["CHAT"];
        if(isset($_POST['message'])){
            $message = $_POST['message'];
            if($message == "") $message = "_";
            $message= $un." : ".$message.'<br>';
            $update = "update chats SET chat=concat(chat,'$message') where bw='$cookie2';";
            mysqli_query($con,$update);
            //echo '<script>window.location.href = "/project/chat.php"; </script>';
        }else{
            $query = "select * from chats where bw='$cookie2';";
            $result = mysqli_query($con,$query);
            $row = $result->fetch_assoc();
            $f = $row['u2'];
            if($f == $un){
                $f = $row['u1'];
            }
            $chats = array_filter(explode('<br>',$row["chat"]));
            //echo "un = $un";
            //echo "<br> f = $f";
            if(count($chats) >= 1 and $chats[0] != ' '){
                foreach ($chats as $x) {
                    $chat = array_filter(explode(' : ',$x));
                    //print_r($chat);
                    if(trim($chat[0]) == $un){
                        echo '<div class="right"><span>'.$chat[1].'</span></div><br>';
                    }else{
                        echo '<div class="left" ><span>'.$chat[1].'</span></div><br>';
                    }
                }
            }
            echo '<div id="bottom"></div>';
            echo '<script>';
            echo "document.getElementById('scroll').scrollIntoView();";
            echo '</script>';

        }
    }
?>
