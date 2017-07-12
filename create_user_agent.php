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

 ?>

<head>
  <title> Create User Agent</title>
  <link rel="stylesheet" href="src/css/w3.css">
</head>
<script src="src/js/index.js"></script>
<body style="background-color:#ff3333;">

  <form action="create_user_agent.php" method="post"  id="form1" class="w3-display-middle w3-container w3-white w3-card-4  w3-text-red  w3-margin">

    <img src="src/img/logo_tam.jpg "  alt="logo_tam" class="w3-margin-top" >

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


</body>
