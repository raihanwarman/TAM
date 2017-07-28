<?php
  session_start();
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

    date_default_timezone_set("Asia/Bangkok");
    $time = date('Y-m-d H:i:s');
    $usr = $_SESSION['agent_usr'];
    echo "<script type='text/javascript'>alert('$time -> $usr');</script>";
    $sales_agree = test_input($_POST['poin_satu']);
    $sales_ps = test_input($_POST['poin_dua']);
    $pnp_score = test_input($_POST['poin_tiga']);
    $attitude_score = test_input($_POST['poin_empat']);
    $kueri = "update agent
              set admin_last_update='$time', sales_agree=$sales_agree , sales_ps=$sales_ps , pnp_score=$pnp_score , attitude_score=$attitude_score
              where username ='$usr'";

    if ($conn->query($kueri) === TRUE)  {
      echo "<script type='text/javascript'>alert('agent sales_agree table agent updated!');</script>";
    }
    else {
      echo "<script type='text/javascript'>alert('agent sales_agree table agent not updated!');</script>";
    }
  }
  $query = "select agent.position as posisi from agent where agent.username = '$usr'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row["posisi"] == 'inbound'){
      header("Location: admin_input_inbound.php");
    }
    else{
      header("Location: admin_input_outbound.php");
    }
  }
?>
