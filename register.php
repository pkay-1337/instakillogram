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
        input[type="password"],
        input[type="text"] {
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
        @media screen and (max-width: 80rem) {
            .container {
                max-width: 100%;
                margin: 100px auto;
                padding: 20px;
                border: 1px solid #ccc;
                background-color: #fff;
            }
          }
    </style>
</head>
<body>

    <div class="container">
        <h2>InstaKilloGram Sign-up</h2>
        <form action="register.php" method="post">                       
            <input type="email" name="email" placeholder="User Email"><br>
            <input type="password" name="pw" placeholder="Password"><br>
            <input type="text" name="un" placeholder="Username"><br>
            <input type="submit" name="do" value="Create Account">
        </form>
        <?php
     $con = mysqli_connect("localhost","db","pk","cimage");
    if(isset($_POST['pw']) and isset($_POST["email"])){
        if($_POST["pw"] != "" and $_POST["email"] != "" and $_POST["un"]){
            $email = $_POST["email"];
            $password = $_POST["pw"];
            $username = $_POST["un"];
            $query = "select * from users where email='$email';";
            $result = mysqli_query($con,$query);
            if ($result->num_rows > 0) 
            {
                echo "An User with This Email already Exists. Please Login.<br>";
            }else{
                $query = "select * from users where username='$username';";
                $result = mysqli_query($con,$query);
                if ($result->num_rows > 0){
                    echo "This UserName is Taken, Try something else.<br>";
                }else{
                    $query2 = "insert into users(email,password,username,photo,following) values('$email','$password','$username',' ', '$username Admin')";
                    $rs = mysqli_query($con,$query2);
                    if($rs){
                        echo "User Added<br>";
                    }else{
                        echo "User not added<br>";
                    }
                } 
                
            }
        }else{
            echo "Please Enter Both Email And Password!<br>";
        }
    }
           // PHP code for user registration remains unchanged

?>
<div style="display: flex; justify-content: space-between; align-items: center;">
    <div style="width: 45%"><hr></div>
    <span style="font-size: 14px;">OR</span>
    <div style="width: 45%"><hr></div>
</div>
    <h2>Already have an account?</h2>
        <button onclick="javascript:window.location.href='/project/login.php'">Login</button>
    </div>
</body>
</html>

