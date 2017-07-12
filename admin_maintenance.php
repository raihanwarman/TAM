<?php
// Start the session
  session_start();
  if($_SESSION['user_pass'] == NULL){
    header("Location: index.php");
  }
  else {

        //Untuk ambil data dari dalam form
        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }



          if ($_SERVER["REQUEST_METHOD"] == "POST") {

          //Connect ke Database
          $conn = new mysqli("localhost", "root", "root", "TAM");
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          else {
            /*
            $message = "Berhasil Masuk Database!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            */
          }

          $username = test_input($_POST["username"]);
          $nama     = test_input($_POST["nama"]);
          $password = test_input($_POST["password"]);
          $gender = test_input($_POST["gender"]);
          $position = test_input($_POST["position"]);

          //Cek role berdasarkan username lalu login
          $query_update_user_table = "insert into user (nama, username, password, role, gender)
                    values('$nama','$username','$password','2','$gender')";
          $query_update_agent_table = "insert into agent(username, login_status,
                    position, sales_day, sales_week, sales_month, performance, status)
                    values('$username', 0, '$position', 0, 0, 0, 0, 0)";
          $query_update_login_note_table = "insert into login_note(username, last_login)
                    values('$username', 0)";
          //update tabel login_note
          if ($conn->query($query_update_login_note_table) === TRUE)  {
            echo "<script type='text/javascript'>alert('login_note updated!');</script>";

          } else {
            echo "<script type='text/javascript'>alert('login_note not updated!');</script>";
          }
          //update tabel agent
          if ($conn->query($query_update_agent_table) === TRUE)  {
            echo "<script type='text/javascript'>alert('agent updated!');</script>";

          } else {
            echo "<script type='text/javascript'>alert('agent not updated!');</script>";
          }
          //update tabel user
          if ($conn->query($query_update_user_table) === TRUE)  {
            echo "<script type='text/javascript'>alert('user updated!');</script>";

          } else {
            echo "<script type='text/javascript'>alert('user not updated!');</script>";
          }
        }
  }

?>
<!DOCTYPE html>
<html>
<title>Admin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="src/css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-red w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <a href="logout.php" class="w3-bar-item w3-right w3-btn w3-red">Logout</a>
  <span class="w3-bar-item w3-left">Admin Console</span>
</div>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <?php
        

        //Connect ke Database
        $conn = new mysqli("localhost", "root", "root", "TAM");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }


        $temp = $_SESSION['user_pass'];
        $query = 'select gender FROM user WHERE username ='.'"'.$temp.'"';
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          if ($row['gender'] == 0){
            echo '<img src=" src\img\admin_female.png" class="w3-circle w3-margin-right" style="width:46px">' ;
          }
          elseif ($row['gender'] == 1) {
            echo '<img src="src\img\admin_male.jpg" class="w3-circle w3-margin-right" style="width:46px">';
          }
        }
       ?>
    </div>
    <div class="w3-col s8 w3-bar">
      <?php
        echo "<span>Welcome, <strong>";echo$_SESSION["user_pass"];echo"</strong></span><br>";
       ?>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="admin.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-eye fa-fw"></i>  Maintenance</a>
    <a href="admin_reporting.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Reporting</a>
    <a href="admin_dapros.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"> </i>  Dapros</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <div class="w3-container w3-padding-32">
    <h4> Create User </h4>
    <form action="admin_maintenance.php" method="post"  id="form1">

      <div class="w3-row w3-section">
        <div class="w3-rest">
          <input class="w3-input w3-border" name="nama" type="text" placeholder="nama">
        </div>
      </div>



      <div class="w3-row w3-section">
        <div class="w3-rest">
          <input class="w3-input w3-border" name="username" type="text" placeholder="username">
        </div>
      </div>



      <div class="w3-row w3-section">
        <div class="w3-rest">
          <input class="w3-input w3-border" name="password" type="text" placeholder="password">
        </div>
      </div>



      <div class="w3-row w3-section">
        <div class="w3-rest">
          <input class="w3-input w3-border" name="gender" type="text" placeholder="gender">
        </div>
      </div>



      <div class="w3-row w3-section">
        <div class="w3-rest">
          <select class="w3-input w3-border" name="position" type="text" placeholder="position">
            <option value="inbound"> Inbound </option>
            <option value="outbound"> Outbound</option>
          </select>
        </div>
      </div>




      <button id"button1" class="w3-button w3-block w3-section w3-padding w3-ripple w3-red"  >Login</button>

    </form>
  </div>




  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}



// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

</body>
</html>
