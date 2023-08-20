<html>
<head>
<style>
.bottomNav {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: #f0f0f0;
  display: flex;
  justify-content: space-around;
  padding: 10px;
  box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow at the bottom */
}

.bottomNav img {
  width: 50px; /* Adjust the width as needed for your logos */
  height: 50px; /* Adjust the height as needed for your logos */
  cursor: pointer;
  transition: transform 0.2s; /* Add a smooth transition effect on hover */
}

.bottomNav img:hover {
  transform: scale(1.1); /* Increase the size slightly on hover */
}
body{
    background-color: #f0f0f0;
    text-align : center;
}
#images{
    grid-template-columns: repeat(auto-fit, minmax(50%, 1fr)); /* Each item takes up 50% width */
    justify-content: center;
    align-items: center;
    display: grid;
    grid-gap: 50px;
    grid-template-rows: 1fr;
}
.post{
  padding: 10px;
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
/*
    justify-content: center;
    align-items: center;
    padding: 20px;
    border: 1px black solid;
    display: grid;
    grid-gap: 10px;
    grid-template-rows: 1fr;
*/
}
.post img{
    padding: 20px;
    max-width:100%;
    background-color: white;
    border: 1px grey solid;
}
.post p{
    margin: 0px;
    padding: 20px;
    padding-bottom: 0px;
    padding-top: 5px;
    width:50%;
    background-color: white;
    border: 1px grey solid;
    font-size: 1.2rem;

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
</style>
</head>
<body>

  <div class="bottomNav">
    <a href="index.php"><img src="photos/home.png" alt="Logo 1"></a>
    <a href="search.php" class="button-link"><img src="photos/search.png" alt="Logo 2"></a>
    <a href="listchat.php"><img src="photos/a.png" alt="Logo 4"></a>
    <a href="profile.php"><img src="photos/b.png" alt="Logo 5"></a>
  </div>
<?php
    // Add Your User, Password, and Database name here  
    $con = mysqli_connect("localhost","db","pk","cimage");
    $cookie = $_COOKIE["Auth"];
    $query = "select * from users where cookie='$cookie';";
    $result = mysqli_query($con,$query);
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc())
        {
            $unn = $row['username'];
            $email = $row['email'];
            $photo = $row['photo'];
            $following = $row['following'];
            echo "<h3 align='center'>Your Username : $unn </h3>";
        }
        if(isset($_POST['logout'])){
            $update = "update users SET cookie='NULL' where cookie='$cookie';";
            mysqli_query($con,$update);
            setcookie("Auth", "", time() - 3600);
            echo '<script>window.location.href = "/project/login.php"; </script>';
        }
        if(isset($_GET['p'])){
            $pf = $_GET['p'];
            $query = "select * from users where username='$pf';";
            $result = mysqli_query($con,$query);
            while($row = $result->fetch_assoc()){
                $un = $row['username'];
                ?>
                <script type="text/javascript">
                    function follow(){
                        const xhttp = new XMLHttpRequest();
                        xhttp.onload = function(){
                            document.getElementById("f").innerHTML = this.responseText;
                        }
                        xhttp.open("GET","follow.php?p=<?php echo $un ?>");
                        xhttp.send();
                    }
                    function unfollow(){
                        const xhttp = new XMLHttpRequest();
                        xhttp.onload = function(){
                            document.getElementById("f").innerHTML = this.responseText;
                        }
                        xhttp.open("GET","unfollow.php?p=<?php echo $un ?>");
                        xhttp.send();
                    }
                function chat(){
                    location.href="chat.php?username=<?php echo $un; ?>";
                }
                </script>
                <?php
                $email = $row['email'];
                $photo = $row['photo'];
                if($un != $unn){
                    echo "<h3 align='center'>Checking Username : $un </h3>";
                    echo '<button onclick="chat();" style="display:inline-block;">Chat</button>';
                }
                $following = preg_split('/\s+/',$following);
                if($pf != $unn){
                    $isit = FALSE;
                    for($i=1; $i<count($following); $i++){
                        if($following[$i] == ""){ continue; }
                        if($following[$i] == $un){
                            $isit=TRUE;
                        }
                    }
                    if($isit == FALSE){
                    ?>
                    <div id="f" style="display:inline-block;">
                        <button onclick="follow();">Follow</button>
                    </div>
                    <?php
                    }
                    if($isit == TRUE){
                    ?>
                    <div id="f" style="display:inline-block;">
                        <button onclick="unfollow();" style="display:inline-block; color:red;">UnFollow</button>
                    </div>
                    <?php
                    }
                }

                ?>
                <?php

                $photos = (preg_split('/\s+/',$photo));
                echo "<div id='images' align='center' >";
                for($i=0; $i<count($photos); $i++){
                    if($photos[$i] == "") continue;
                    echo "<div class='post'>";
                    echo "<p>$pf</p>";
                    echo "<img src='users/photos/$photos[$i]' width='50%'>";
                    echo "</div>";
                }
                echo "</div>";
                /*
                for($i=1; $i<count($photos); $i++){
                    if($photos[$i] == "") continue;
                    echo "<img src='users/photos/$photos[$i]' width='500px'><br>";
                }
                 */
            }
        }else{
            $pf = $unn;
            $query = "select * from users where username='$pf';";
            $result = mysqli_query($con,$query);
            while($row = $result->fetch_assoc()){
                $un = $row['username'];
                $email = $row['email'];
                $photo = $row['photo'];
                $photos = (preg_split('/\s+/',$photo));
                echo "<div id='images' align='center' >";
                for($i=0; $i<count($photos); $i++){
                    if($photos[$i] == "") continue;
                    echo "<div class='post'>";
                    echo "<p>$un</p>";
                    echo "<img src='users/photos/$photos[$i]' width='50%'>";
                    echo "</div>";
                }
                echo "</div>";
                /*
                for($i=1; $i<count($photos); $i++){
                    if($photos[$i] == "") continue;
                    echo "<img src='users/photos/$photos[$i]' width='500px'><br>";
                }
                 */
            }
        }
        
    }else{
        setcookie("Auth", "", time() - 3600);
        echo '<script>window.location.href = "/project/login.php"; </script>';
    } 
?>
<form action="profile.php" method="post">                       
        <input type="submit" name="logout" value="logout">
</form>
<br>
<br>
<br>
<br>
<br>
</body>
</html>
