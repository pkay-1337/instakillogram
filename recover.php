<html>
<body>
<form action="recover.php" method="post">                       
        User Email : <input type="email" name="un"><br>
        New Password   : <input type="password" name="pw"><br>
        <input type="submit" name="do" value="Login">
</form>
<?php
    $con = mysqli_connect("localhost","db","pk","cimage");
    if(isset($_POST['pw'])){
        $username = $_POST["un"];
        $password = $_POST["pw"];
        $query = "select * from users where email='$username';";
        $result = mysqli_query($con,$query);
        if ($result->num_rows > 0) 
        {
            // OUTPUT DATA OF EACH ROW
            while($row = $result->fetch_assoc())
            {

                $update = "update users SET password='$password' where email='$username';";
                mysqli_query($con,$update);
                echo "<br><h1> Password Updated</h1>";
                /*
                if($password == $row["password"]){
                    $cookie = $username;
                    for($i=strlen($cookie); $i<32; $i++){
                        $cookie= $cookie.'a';
                    }
                    $update = "update users SET cookie='$cookie' where email='$username';";
                    mysqli_query($con,$update);
                    setcookie("Auth", "$cookie", time() + 2 * 24 * 60 * 60);
                    echo '<script>window.location.href = "/project/index.php"; </script>';
                 */
            }
        } 
        else {
            echo "Wrong Email";
        }
    }
?>
Login Here -> <button><a href="/project/login.php">Login</a></button>
</body>
</html>
