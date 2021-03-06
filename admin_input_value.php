<?php
// Start the session
session_start();
if($_SESSION['user_pass'] == NULL){
  header("Location: index.php");
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
          //Untuk ambil data dari dalam form
        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }

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
        echo "<span>Welcome, <strong>";echo$_SESSION["nama_pass"];echo"</strong></span><br>";
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
    <a href="admin_maintenance.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Maintenance</a>
    <a href="admin_input_inbound.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i> Input Inbound</a>
    <a href="admin_input_outbound.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i> Input Outbound</a>
    <a href="admin_agent_data.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i> Agent Data</a>
    <a href="admin_cluster_agent.php" class="w3-bar-item w3-button w3-padding "><i class="fa fa-bullseye fa-fw"> </i>  Cluster Agent</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <header class="w3-container" style="padding-top:22px">
    <?php

      $kueri = "select user.nama as nama, agent.position as posisi from(user inner join agent on user.username = agent.username) where user.username ='".$_GET["usr"]."'";
      $result = mysqli_query($conn, $kueri);
      ///
      $usr = $_GET["usr"];
      if (mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
          echo'<h5><b><i class="fa fa-dashboard"></i> Input Value '.$row["nama"].' ( '.$row["posisi"].' )</b></h5>';
          $posisi = $row["posisi"];
        }
      }
      $_SESSION['agent_pos'] = $posisi;
      $_SESSION['agent_usr'] = $usr;
    ?>

  </header>

  <div class="w3-container ">
    <form action="admin_input_process.php" method="post"  id="form1">
      <div class="w3-row-padding">
        <div class="w3-half">
          <p class="w3-justify">Jumlah Sales Agree</p>
        </div>
        <div class="w3-half">
          <input class="w3-input w3-border" name="poin_satu" type="text" placeholder="Jumlah Sales Agree" required>
        </div>
      </div>

      <div class="w3-row-padding">
        <div class="w3-half">
          <p class="w3-justify">Jumlah Sales PS</p>
        </div>
        <div class="w3-half">
          <input class="w3-input w3-border" name="poin_dua" type="text" placeholder="Jumlah Sales PS" required>
        </div>
      </div>

      <div class="w3-row-padding">
        <div class="w3-half">
          <p class="w3-justify">PNP Score</p>
        </div>
        <div class="w3-half">
          <input class="w3-input w3-border" name="poin_tiga" type="text" placeholder="PNP Score" required>
        </div>
      </div>

      <div class="w3-row-padding">
        <div class="w3-half">
          <p class="w3-justify">Attitude & Collaboration</p>
        </div>
        <div class="w3-half">
          <input class="w3-input w3-border" name="poin_empat" type="text" placeholder="Attitude & Collaboration" required>
        </div>
      </div>
      <button id"button1" class="w3-button w3-right w3-section w3-padding w3-ripple w3-red"  >Submit</button>
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
