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
        $email = $row['email'];
        $sql = "select * from chats where u1='$un' or u2='$un'";
        $result2 = $conn->query($sql);
    }
}else{
        setcookie("Auth", "", time() - 3600);
        echo '<script>window.location.href = "/project/login.php"; </script>';
    } 

/*$items = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row['username'];
    }
}
 */

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Messages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            padding: 20px;
            margin: 0px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: 400px;
            /*flex-wrap: wrap;*/
            justify-content: center;
            text-align: center;
        }

        li {
            margin: 10px;
        }

        .aa {
            display: block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            align: center;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .aa:hover {
            background-color: #2980b9;
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

/* Style for the middle button */
        /* Add media query for responsiveness */
        @media screen and (max-width: 600px) {
            .search-container {
                max-width: 90%;
            }
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
.button-link {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50px; /* Adjust the width as needed for the button */
  height: 50px; /* Adjust the height as needed for the button */
  border: none;
  border-radius: 50%;
  /*background-color: #3897f0;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Add a shadow for the button */
  cursor: pointer;
}

.button-link img {
  width: 30px; /* Adjust the size of the logo inside the button */
  height: 30px; /* Adjust the size of the logo inside the button */
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
  <h1>Messages</h1>
    <ul>
        <?php while ($row = $result2->fetch_assoc()) { ?>
            <li>
                <?php
                if($row['u1'] == $un){
                    echo '<a class="aa" href="chat.php?username='.($row['u2']).'">';
                    echo htmlspecialchars($row['u2']); 
                    echo '</a>';
                }
                if($row['u2'] == $un){
                    echo '<a class="aa" href="chat.php?username='.($row['u1']).'">';
                    echo htmlspecialchars($row['u1']); 
                    echo '</a>';

                }
                ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</body>

</html>

