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
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-bullseye fa-fw"> </i>  Cluster Agent</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-half">
      <h6></h6>
      <div class="w3-bar w3-large w3-deep-orange w3-margin-bottom" >
        <span class="w3-bar-item w3-left">Inbound Agent</span>
      </div>
      <table class="w3-table-all">
        <thead>
         <tr class="w3-light-grey">
           <th>Nama</th>
           <th>Mandatory Score</th>
           <th>Basic Score</th>
           <th>Status</th>
         </tr>
       </thead>
       <?php
         $query="select user.username as username, user.nama as nama from
                (user inner join agent on user.username = agent.username)
                where agent.position = 'inbound' order by nama ASC ";
         $query='select user.nama as nama, agent.username as username,agent.position as posisi,
                 agent.performance as performa, agent.sales_agree as sales_agree, agent.sales_ps as sales_ps,
                 agent.pnp_score as pnp_score, agent.attitude_score as attitude_score
                 from (user inner join agent on agent.username = user.username) where
                 agent.role = "sales" && agent.position = "inbound"';
         $result = mysqli_query($conn, $query);
         $mandatory = 10.2;
         $basic = 0.1;
         $total = 0.2;
         $platinum_mandatory = 68.75;
         $platinum_total = 82.5;
         $gold_mandatory = 41.8 + 23.5125;
         $gold_total = 79.0625;
         $silver_mandatory = 39.6 + 22.275;
         $silver_total = 75.4875;
         $bronze_mandatory = 37.4 + 21.0375;
         $bronze_total = 74.6625;
         $bronze_basic = 4.41 + 4.655 + 4.41;
         $cluster = "tes";
         //tulis output di tabel
         if (mysqli_num_rows($result) > 0) {
           while($row = $result->fetch_assoc()) {
             echo"<tr>";
             echo"<td>".$row["nama"]."</td>";
             $mandatory = $row['sales_agree'] * 0.4 + $row['sales_ps'] * 0.45;
             $basic = $row['pnp_score'] * 0.05 + $row['performa'] * 0.05 + $row['attitude_score'] * 0.05;
             $total = $mandatory + $basic;
             echo"<td>".$mandatory."</td>";
             echo"<td>".$basic."</td>";
              if ($basic > $bronze_basic){
                if ($mandatory >= $platinum_mandatory){
                  $cluster = "platinum";
                }
                elseif($mandatory >= $gold_mandatory){
                  $cluster = "gold";
                }
                elseif($mandatory >= $silver_mandatory){
                  $cluster = "silver";
                }
                elseif($mandatory >= $bronze_mandatory){
                  $bronze = "gold";
                }
                else{
                  $cluster = "underperformed";
                }
              }
              else {
                if($total >= $platinum_total){
                  $cluster = "platinum";
                }
                elseif($total >= $gold_total){
                  $cluster = "gold";
                }
                elseif($total >= $silver_total){
                  $cluster = "silver";
                }
                elseif($total >= $bronze_total){
                  $cluster = "bronze";
                }
                else {
                  $cluster = "underperformed";
                }
              }
            echo"<td>".$cluster."</td>";
             echo"</tr>";
             $query_update = "update agent set cluster =$cluster where agent.username =".$row["username"];
             $conn->query($query_update);
           }
         }
       ?>

      </table>
     </div>
     <div class="w3-half">
       <h6></h6>
       <div class="w3-bar w3-large w3-deep-orange w3-margin-bottom" >
         <span class="w3-bar-item w3-left">Outbound Agent</span>
       </div>
       <table class="w3-table-all">
         <thead>
          <tr class="w3-light-grey">
            <th>Nama</th>
            <th>Mandatory Score</th>
            <th>Basic Score</th>
            <th>Status</th>
          </tr>
        </thead>
        <?php
        $query='select user.nama as nama, agent.username as username,agent.position as posisi,
                agent.performance as performa, agent.sales_agree as sales_agree, agent.sales_ps as sales_ps,
                agent.pnp_score as pnp_score, agent.attitude_score as attitude_score
                from (user inner join agent on agent.username = user.username) where
                agent.role = "sales" && agent.position = "outbound"';
          $result = mysqli_query($conn, $query);
          //tulis output di tabel
          if (mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
              echo"<tr>";
              echo"<td>".$row["nama"]."</td>";
              $mandatory = $row['sales_agree'] * 0.4 + $row['sales_ps'] * 0.45;
              $basic = $row['pnp_score'] * 0.05 + $row['performa'] * 0.05 + $row['attitude_score'] * 0.05;
              $total = $mandatory + $basic;
              echo"<td>".$mandatory."</td>";
              echo"<td>".$basic."</td>";
               if ($basic > $bronze_basic){
                 if ($mandatory >= $platinum_mandatory){
                    $cluster = "platinum";
                 }
                 elseif($mandatory >= $gold_mandatory){
                   $cluster = "gold";
                 }
                 elseif($mandatory >= $silver_mandatory){
                   $cluster = "silver";
                 }
                 elseif($mandatory >= $bronze_mandatory){
                   $bronze = "gold";
                 }
                 else{
                   $cluster = "underperformed";
                 }
               }
               else {
                 if($total >= $platinum_total){
                   $cluster = "platinum";
                 }
                 elseif($total >= $gold_total){
                   $cluster = "gold";
                 }
                 elseif($total >= $silver_total){
                   $cluster = "silver";
                 }
                 elseif($total >= $bronze_total){
                   $cluster = "bronze";
                 }
                 else {
                   $cluster = "underperformed";
                 }
               }
             echo"<td>".$cluster."</td>";
              echo"</tr>";
              $query_update = "update agent set cluster ='$cluster' where agent.username ='".$row["username"]."'";
              $conn->query($query_update);
            }
          }
        ?>
       </table>
      </div>
   </div>

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
