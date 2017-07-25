<?php
  session_start();
 ?>
<!DOCTYPE html>

<?php

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

    $usr = test_input($_POST["username"]);
    $pswrd = test_input($_POST["password"]);
    echo "<script type='text/javascript'>alert('halo $usr!');</script>";
    //Cek role berdasarkan username lalu login
    $query = "select * FROM user WHERE username = '$usr' AND password = '$pswrd'";
    $result = mysqli_query($conn, $query);
    ///
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION["user_pass"] = $row['username'];
      $_SESSION["nama_pass"] = $row['nama'];
      if ($row['role'] == 0){
        header("Location: admin.php");
      }
      elseif ($row['role'] == 1) {
        header("Location: quality.php");
      }
      elseif ($row['role'] == 2) {
        header("Location: agent.php");
      }
    }
    else {
      echo "<script type='text/javascript'>alert('ga nemu hasilnya cuy');</script>";
    }
  }

 ?>

<head>
  <title> Login</title>
  <link rel="stylesheet" href="src/css/w3.css">
</head>
<script src="src/js/index.js"></script>
<body style="background-color:#ff3333;">

  <form action="index.php" method="post"  id="form1" class="w3-display-middle w3-container w3-white w3-card-4  w3-text-red  w3-margin">

    <img src="src/img/logo_tam.jpg "  alt="logo_tam" class="w3-margin-top" >

    <div class="w3-row w3-section">
      <div class="w3-rest">
        <input id="myText" class="w3-input w3-border" name="username" type="text" placeholder="username">
      </div>
    </div>



    <div class="w3-row w3-section">
      <div class="w3-rest">
        <input class="w3-input w3-border" id="pswrd" name="password" type="password" placeholder="password">
      </div>
    </div>




    <button id"button1" class="w3-button w3-block w3-section w3-padding w3-ripple w3-red"  >Login</button>

  </form>


</body>
