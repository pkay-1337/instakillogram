<html>
<head>
<style>
.popupBackground {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1;
}

.popupContent {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  z-index: 2;
  max-width: 90%;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}
.popupInnerContent {
  text-align: center;
}

form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

label {
  margin: 10px 0;
  font-size: 18px;
}

input[type="file"] {
  display: none;
}

span.file-name {
  margin: 10px 0;
  font-size: 14px;
}

.browse-btn, #submitBtn {
  background-color: #3897f0;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 15px;
  cursor: pointer;
  font-size: 18px;
  display: inline-block;
}

.browse-btn input[type="file"] {
  display: none;
}

button{
  background-color: #ccc;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 15px;
  cursor: pointer;
  font-size: 18px;
}

#submitBtn {
  background-color: #3897f0;
  margin-bottom:10px;
}
/* Styles for your page content */
/* Add styles here as per your page's layout */

/* Styles for the bottom fixed div */
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

/* Style for the custom button (Logo 3) */
.custom-button {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50px; /* Adjust the width as needed for the button */
  height: 50px; /* Adjust the height as needed for the button */
  border: none;
  border-radius: 50%;
  /*background-color: #ff5722; /* Use a different color for the custom button */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Add a shadow for the button */
  cursor: pointer;
  color: #fff;
  font-weight: bold;
}
body{
    background-color: #f0f0f0;
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
</style>
</head>
<body align="center">
<br>

<!---  <button id="showPopupBtn">Upload</button> -->
  <div class="bottomNav">
    <a href="index.php"><img src="photos/home.png" alt="Logo 1"></a>
    <a href="search.php" class="button-link"><img src="photos/search.png" alt="Logo 2"></a>
    <button class="custom-button" id="showPopupBtn"><img src="photos/plus.png"></img></button>
    <a href="listchat.php"><img src="photos/a.png" alt="Logo 4"></a>
    <a href="profile.php"><img src="photos/b.png" alt="Logo 5"></a>
  </div>


  <div class="popupBackground" id="popupBackground">
    <div class="popupContent">
      <div class="popupInnerContent">
        <!-- Your content for the popup goes here -->
        <form action="index.php" method="post" enctype="multipart/form-data" id="myForm">
            <label for="img">Add Image:</label>
            <label class="browse-btn">
                Browse
            <input type="file" name="img" id="img" onchange="checkFile()" accept="image/*">
            </label>
            <span class="file-name">No file selected</span>
            <input type="submit" name="submit-img" value="Submit Image" id="submitBtn">
            <button id="closePopupBtn">Cancel</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    const showPopupBtn = document.getElementById("showPopupBtn");
    const popupBackground = document.getElementById("popupBackground");
    const closePopupBtn = document.getElementById("closePopupBtn");
    const fileNameLabel = document.querySelector(".file-name");
    const inputFile = document.getElementById("img");
    showPopupBtn.addEventListener("click", function () {
      popupBackground.style.display = "block";
    });

    closePopupBtn.addEventListener("click", function () {
      popupBackground.style.display = "none";
    });
    function checkFile() {
      if (inputFile.value) {
        fileNameLabel.textContent = inputFile.files[0].name;
        submitBtn.style.display = "block";
      } else {
        fileNameLabel.textContent = "No file selected";
        submitBtn.style.display = "none";
      }
    };
  </script>

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
            $un = $row['username'];
            $email = $row['email'];
            $photo = $row['photo'];
            $photo = preg_split('/\s+/',$photo);
            for($i=0; $i<count($photo);$i++){
                $photo[$i] = "$un:".$photo[$i];
            }
            //print_r($photo);
            $following = $row['following'];
            $following = preg_split('/\s+/',$following);
            for($i=1; $i<count($following); $i++){
                if($following[$i] == ""){ continue; }
                $query = "select photo from users where username='$following[$i]';";
                $result = mysqli_query($con,$query);
                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc())
                    {
                        $x = $row['photo'];
                        $x = preg_split('/\s+/',$x);
                        for($j=0; $j<count($x);$j++){
                            $x[$j] = $following[$i].':'.$x[$j];
                        }
                        $photo = array_merge($x,$photo);
                    }
                }
            }
                        //print_r($photo);
            echo "<h3 align='center'> $un </h3>";
        }
        if(isset($_POST['submit-img'])){
                //print_r($_FILES["img"]);
                //shell_exec('mkdir /srv/http/project/users/photos');
                $name =  basename($_FILES['img']["tmp_name"]);
                $target = "/srv/http/project/users/photos/".$name;
                move_uploaded_file($_FILES["img"]["tmp_name"], $target);
                $update = "update users SET photo=concat(photo,' $name') where cookie='$cookie';";
                mysqli_query($con,$update);
                echo '<script>window.location.href = "/project/"; </script>';
        }
        //$photos = preg_split('/\s+/',$photo);
        //print_r($photo);
        shuffle($photo);
        $photos = $photo;
        echo "<div id='images' align='center' >";
        for($i=0; $i<count($photos); $i++){
            $z= explode(':',$photos[$i]);
            if($z[1] == "") continue;
            echo "<div class='post'>";
            echo "<p>$z[0]</p>";
            echo "<img src='users/photos/$z[1]' width='50%'>";
            echo "</div>";
        }
        echo "</div>";

    }else{
        setcookie("Auth", "", time() - 3600);
        echo '<script>window.location.href = "/project/login.php"; </script>';
    } 
?>
<br><br><br>
</body>
</html>
