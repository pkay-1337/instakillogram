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
        //$following = preg_split('/\s+/',$following);
        $resultt = "";
        $following = array_filter(explode($pf,$following));
        for($i=0; $i<count($following); $i++){
            $resultt = $resultt." ".$following[$i];
        }
        $resultt = trim($resultt);
        //echo "Following<br>";
        $update = "update users SET following='$resultt' where cookie='$cookie';";
        mysqli_query($con,$update);
?>
        <div id="f" style="display:inline-block;">
            <button onclick="follow();">Follow</button>
        </div>
<?php
    }

?>
