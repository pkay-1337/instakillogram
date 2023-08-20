<html>
<head>
<style>
</style>
</head>
<body>
<?php
    // Add Your User, Password, and Database name here  
    $pf = $_GET['p'];
    $con = mysqli_connect("localhost","db","pk","cimage");
    $cookie = $_COOKIE["Auth"];
    $query = "select * from users where cookie='$cookie';";
    $result = mysqli_query($con,$query);
    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc())
        {
            $un = $row['username'];
            $following = $row['following'];
            //echo "<h3>Your Username : $un </h3>";
        }
        $following = preg_split('/\s+/',$following);
        $isit = FALSE;
        for($i=1; $i<count($following); $i++){
            if($following[$i] == ""){ continue; }
            if($following[$i] == $un){
                $isit=TRUE;
            }
        }
        if($isit == FALSE){
            //echo "<a href='follow.php?p=".$pf."'>Follow</a><br>";
            $update = "update users SET following=concat(following,' ".$_GET["p"]."') where cookie='$cookie';";
            mysqli_query($con,$update);
                    ?>
                    <div id="f" style="display:inline-block;">
                        <button onclick="unfollow();" style="display:inline-block; color:red;">UnFollow</button>
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

        //echo '<script>window.location.href = "profile.php"; </script>';
    }

?>
