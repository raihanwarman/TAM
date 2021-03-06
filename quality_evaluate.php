<?php
// Start the session
session_start();
  if($_SESSION['user_pass'] == NULL){
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html>
<title>Quality</title>
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
  <span class="w3-bar-item w3-left">Quality Assurance Console</span>

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
    <a href="quality.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Agent Monitoring</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Evaluate Agent</a>
    <a href="quality_review.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"> </i>  Review</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <<?php
    date_default_timezone_set("Asia/Bangkok");
    $time = date('Y-m-d H:i:s');
    $periode = ceil(date('d') / 10);
    echo '<header class="w3-container" style="padding-top:22px">
          <h5><b><i class="fa fa-dashboard"></i> Evaluate Agent - Periode '.$periode.'</b></h5>
          </header>';
  ?>
  <!-- <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Evaluate Agent</b></h5>
  </header> -->

    <table class="w3-table-all">
      <thead>
       <tr class="w3-light-grey">
         <th>Nama</th>
         <th>Performansi</th>
         <th> Last updated</th>
         <th> Keterangan</th>
         <th>Action</th>
       </tr>
     </thead>
   <?php



      if ($periode == 1){
        $query2="select user.username as username, user.nama as nama, agent_performance_1.total as performance,
                 agent.last_update_performance as last, agent.position as posisi from (user inner join quality_to_agent on
                 user.username = quality_to_agent.agent_id inner join agent on user.username = agent.username inner join
                 agent_performance_1 on user.username = agent_performance_1.username)
                 where quality_to_agent.quality_id = '".$_SESSION["user_pass"]."'";
      }
      elseif($periode == 2){
        $query2="select user.username as username, user.nama as nama, agent_performance_2.total as performance,
                 agent.last_update_performance as last, agent.position as posisi from (user inner join quality_to_agent on
                 user.username = quality_to_agent.agent_id inner join agent on user.username = agent.username inner join
                 agent_performance_2 on user.username = agent_performance_2.username)
                 where quality_to_agent.quality_id = '".$_SESSION["user_pass"]."'";
      }
      elseif($periode == 3){
        $query2="select user.username as username, user.nama as nama, agent_performance_3.total as performance,
                 agent.last_update_performance as last, agent.position as posisi from (user inner join quality_to_agent on
                 user.username = quality_to_agent.agent_id inner join agent on user.username = agent.username inner join
                 agent_performance_3 on user.username = agent_performance_3.username)
                 where quality_to_agent.quality_id = '".$_SESSION["user_pass"]."'";
      }
     $result = mysqli_query($conn, $query2);
     //tulis output di tabel
     if (mysqli_num_rows($result) > 0) {
       while($row = $result->fetch_assoc()) {
         echo"<tr>";
         echo"<td>".$row["nama"]."</td>";
         if($row["performance"] == NULL){
           echo"<td>0</td>";
           echo"<td>".date('d-M-Y',strtotime($row["last"]))."</td>";
           echo'<td>Nilai belum di input</td>';
           echo'<td><a href="quality_evaluate_input_value.php?usr='.$row["username"].'"'. 'class="w3-button w3-padding "><i class="fa fa-arrow-right fa-fw"></i></a><small>Input Nilai</small></td>';
         }
         else{
           echo'<td>'.$row["performance"].'</td>';
           echo"<td>".date('d-M-Y',strtotime($row["last"]))."</td>";
           echo'<td>Nilai sudah di input</td>';
           echo'<td><a href="quality_evaluate_input_value.php?usr='.$row["username"].'"'. 'class="w3-button w3-padding "><i class="fa fa-pencil-square-o"></i></a><small>Edit Nilai</small></td>';
         }
         echo"</tr>";
       }
     }
   ?>

  </table>

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>

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
