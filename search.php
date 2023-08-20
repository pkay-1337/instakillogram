<?php
// Connect to the database
$conn = mysqli_connect("localhost","db","pk","cimage");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cookie = $_COOKIE["Auth"];
$query = "select * from users where cookie='$cookie';";
$result = mysqli_query($conn,$query);
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc())
    {
        $un = $row['username'];
    }
    // Fetch all items from the database
    $sql = "SELECT username FROM users";
    $result = $conn->query($sql);

    $items = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row['username'];
        }
    }
}else{
        setcookie("Auth", "", time() - 3600);
        echo '<script>window.location.href = "/project/login.php"; </script>';
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Search Bar with Datalist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Add responsive styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .search-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

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
table{
    margin-top:50px;
    text-align:center;
}
/* Style for the middle button */
        /* Add media query for responsiveness */
        @media screen and (max-width: 600px) {
            .search-container {
                max-width: 90%;
            }
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
    <div class="search-container">
        <form method="get" action="/project/profile.php">
            <input type="text" name="p" list="item_list" placeholder="Search for items">
            <datalist id="item_list">
                <?php
                // Display the items in the datalist
                foreach ($items as $item) {
                    echo "<option value='" . htmlspecialchars($item) . "'>";
                }
                ?>
            </datalist>
            <input type="submit" value="Search">
        </form>
<table border="1" width="400" align="center" >
    <tr>
        <th>All Users</th>
        <?php
            for($i=0; $i < count($items); $i++){
                if( (strcmp($un,$items[$i]) == 0 )){ continue; };
                echo "<tr><td>".$items[$i]."</td></tr>";
            }
        ?>
    </tr>
</table>
    </div>
</body>

</html>

