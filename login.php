<!DOCTYPE html>
<html>
<head>
    <title>InstaKilloGram Login</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff; 
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"]
        {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"], button {
            width: 100%;
            padding: 10px;
            background-color: #3897f0;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        input[type="submit"]:hover,button:hover {
            background-color: #1874cd;
        }

        p {
            text-align: center;
        }

        button {
            text-align: center;
            margin-top: 10px;
 }

    </style>
</head>
<body>
    <div class="container">
    <h2>InstaKilloGram Login</h2>
    <form action="login.php" method="post">                       
        <input type="email" name="un" placeholder="User Email">
        <input type="password" name="pw" placeholder="Password">
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
                if($password == $row["password"]){
                    $cookie = $username;
                    for($i=strlen($cookie); $i<32; $i++){
                        $cookie= $cookie.'a';
                    }
                    $update = "update users SET cookie='$cookie' where email='$username';";
                    mysqli_query($con,$update);
                    setcookie("Auth", "$cookie", time() + 2 * 24 * 60 * 60);
                    echo '<script>window.location.href = "/project/index.php"; </script>';
                }else{
                    echo "Wrong Username or Password";
                }
            }
        } 
        else {
            echo "Wrong Username or Password";
        }
    }
    if(isset($_COOKIE['Auth'])){
        echo '<script>window.location.href = "/project/index.php"; </script>';
    }
        // Your PHP login code remains unchanged
    ?>
    <!--<p>Forgot Password? <a href="/project/recover.php">Change Password</a></p>-->
<div style="display: flex; justify-content: space-between; align-items: center;">
    <div style="width: 45%"><hr></div>
    <span style="font-size: 14px;">OR</span>
    <div style="width: 45%"><hr></div>
</div>
    <h2>Don't have an Account?</h2>
    <button onclick="javascript:window.location.href='/project/register.php'">Register</button>
    </div>
</body>
</html>

