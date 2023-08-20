<!DOCTYPE html>
<html>
<head>
  <title>Chat Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 2rem;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
      background-color: #f0f0f0;
    }
        input[type="text"] {
            width: 75%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"],button{
            margin-top: 0px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
    .container {
        display:grid;
        grid-template-rows: 1fr;
        grid-template-areas:"header" "chat" "send";
        width: 600px;
        padding:20px;
      border: 1px solid #ccc;
      background-color: #fff;
      margin-top:2vh;
      margin-bottom:2vh;
    }
    h3{
    margin:0px;
    text-align:right;
}
    .header{
        grid-area: header;
    }
    .header h3{
        align:right;
}
    .chat_area{
    grid-area: chat;
    }
    .send_message{
        grid-area: send;
    }

    #chat {
      height:75vh;
      overflow:scroll;
      display: flex;
      flex-direction: column;
    }

    .left,
    .right {
      display: flex;
      justify-content: center;
      margin: 5px;
    }

    .left span,
    .right span {
      padding: 5px 10px;
      background-color: lightblue; /* Add your desired background color here */
      border-radius: 10px;
    }

    .right {
      justify-content: flex-end;
    }
    .left {
      justify-content: flex-start;
    }
    .right span {
      background-color: lightgreen; /* Add your desired background color here */
    }
  </style>
</head>
<body>
  <div class="container">
<?php
    $con = mysqli_connect("localhost","db","pk","cimage");
    $cookie = $_COOKIE["Auth"];
    $query = "select * from users where cookie='$cookie';";
    $result = mysqli_query($con,$query);
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc())
        {
            $un = $row['email'];
            $username = $row['username'];
        }
        if(isset($_GET['username'])){
            $friend = $_GET['username'];
            //$data = '{'.$data.'}';
            //echo $friend."<br>";

            $query = "select * from users where username='$friend';";
            $result = mysqli_query($con,$query);
            if ($result->num_rows > 0) 
            {
                $row = $result->fetch_assoc();
                $username_friend = $row['username'];
                $a= $username;
                $b= $friend;

            //echo $a."<br>";
            //echo $b."<br>";
                $a = str_split($a);
                $b = str_split($b);
                $id = 0;
                foreach($a as $x){
                    $id =  $id + ord($x);
                }
                foreach($b as $x){
                    $id =  $id + ord($x);
                }
                echo "Chat id : ".$id."<br>";
                $query = "select * from chats where bw='$id';";
                $result = mysqli_query($con,$query);
                if ($result->num_rows > 0) 
                {
                    echo '';
                }else{
                    $query2 = "insert into chats(bw,chat,u1,u2) values('$id',' ','$username','$friend')";
                    mysqli_query($con,$query2);

                }

                setcookie("CHAT", "$id", time() + 2 * 24 * 60 * 60);
                echo '<script>window.location.href = "/project/chat.php"; </script>';

            }else{
                echo "This User Doesn't Exist. Please Check email.<br>";
            }

        }
        //echo $cookie2;

    }else{
        setcookie("Auth", "", time() - 3600);
        echo '<script>window.location.href = "/project/login.php"; </script>';
    } 
?>
<?php
    if(isset($_COOKIE["CHAT"])){
        $cookie2 = $_COOKIE["CHAT"];
        $query = "select * from chats where bw='$cookie2';";
        $result = mysqli_query($con,$query);
        $row = $result->fetch_assoc();
        $f = $row['u2'];
        if($f == $username){
            $f = $row['u1'];
        }

        /*
        if(isset($_POST['send'])){
            $message = $_POST['message'];
            $message= $un." : ".$message.'<br>';
            $update = "update chats SET chat=concat(chat,'$message') where bw='$cookie2';";
            mysqli_query($con,$update);
            echo '<script>window.location.href = "/project/chat.php"; </script>';
        }
         */
    }

    echo "<div class='header'><button style='display:inline-block;margin-right:20px;' onclick='back();'>Back</button><h3 style='display:inline-block;padding:10px;'>Chatting With : $f"."</h3>";
    echo "<hr></div>";

?>
<div class="chat_area">
<div id="chat"></div>
<div id="scroll"></div>
</div>
<div class="send_message">
<hr>
<!--<iframe src="listChat.php" id="abcd" scrolling="no" width="500" height="600" ></iframe>--!>
<form action="chat.php" method="post" id="message_form">                       
        <input type="text" name="message">
        <input type="submit" name="send" value="Send">
</form>
</div>

<!---
    <script>
    function reloadIFrame() {
        document.getElementById("abcd").src="listChat.php";
    }
    setInterval("reloadIFrame();", 10000); 
    </script>
---!>
    <script>
        function back(){
            location.href = "listchat.php";
}
        function getChat(){
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function(){
                document.getElementById("chat").innerHTML = this.responseText;
                scrollToBottom();
            }
            xhttp.open("GET","/project/listChat.php");
            xhttp.send();
        }
        function scrollToBottom() {
            var scrollableDiv = document.getElementById("chat");
            scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
        }
        scrollToBottom();
        //setInterval("scrollToBottom();", 1000); 
        getChat();
        setInterval("getChat();", 5000); 
        document.getElementById("message_form").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission from reloading the page

            var form = event.target; // Get the form element
            console.log(form);
            var formData = new FormData(form); // Create FormData object to collect form data

            var xhr = new XMLHttpRequest(); // Create new XHR object
            if(formData == '') return;
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Display the response from the server
                        //document.getElementById("response").textContent = xhr.responseText;
                        form.reset();
                        getChat();
                    } else {
                        // Handle the error
                        console.error("Error: " + xhr.status);
                    }
                }
            };
            scrollToBottom();

            // Open the connection to the server and send the POST request
            xhr.open("POST", "listChat.php"); // Replace "submit_form.php" with the URL to your server-side script
            xhr.send(formData); // Send the form data to the server
            scrollToBottom();
        });
    </script>
  </div>
</body>
</html>

