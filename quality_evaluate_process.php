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

    $satu = test_input($_POST["poin_14_satu"]);
    $dua = test_input($_POST["poin_14_dua"]);
    $usr = $_SESSION['agent_usr'];
    $posisi = $_SESSION['agent_pos'];
    if ($posisi == 'inbound'){
      $p11 = (test_input($_POST['poin_1_satu']) + test_input($_POST['poin_1_dua'])) / 2 * 0.025;
      $p12 = (test_input($_POST['poin_2_satu']) + test_input($_POST['poin_2_dua'])) / 2 * 0.025;
      $p13 = (test_input($_POST['poin_3_satu']) + test_input($_POST['poin_3_dua'])) / 2 * 0.03;
      $p14 = (test_input($_POST['poin_4_satu']) + test_input($_POST['poin_4_dua'])) / 2 * 0.03;
      $p15 = (test_input($_POST['poin_5_satu']) + test_input($_POST['poin_5_dua'])) / 2 * 0.03;
      $p16 = (test_input($_POST['poin_6_satu']) + test_input($_POST['poin_6_dua'])) / 2 * 0.03;
      $p17 = (test_input($_POST['poin_7_satu']) + test_input($_POST['poin_7_dua'])) / 2 * 0.03;
      $p21 = (test_input($_POST['poin_8_satu']) + test_input($_POST['poin_8_dua'])) / 2 * 0.1;
      $p31 = (test_input($_POST['poin_9_satu']) + test_input($_POST['poin_9_dua'])) / 2 * 0.2;
      $p41 = (test_input($_POST['poin_10_satu']) + test_input($_POST['poin_10_dua'])) / 2 * 0.2;
      $p42 = (test_input($_POST['poin_11_satu']) + test_input($_POST['poin_11_dua'])) / 2 * 0.05;
      $p43 = (test_input($_POST['poin_12_satu']) + test_input($_POST['poin_12_dua'])) / 2 * 0.025;
      $p44 = (test_input($_POST['poin_13_satu']) + test_input($_POST['poin_13_dua'])) / 2 * 0.025;
      $p51 = (test_input($_POST['poin_14_satu']) + test_input($_POST['poin_14_dua'])) / 2 * 0.1;
      $p52 = (test_input($_POST['poin_15_satu']) + test_input($_POST['poin_15_dua'])) / 2 * 0.1;
    }
    elseif($posisi == 'outbound'){
      $p11 = (test_input($_POST['poin_1_satu']) + test_input($_POST['poin_1_dua'])) / 2 * 0.025;
      $p12 = (test_input($_POST['poin_2_satu']) + test_input($_POST['poin_2_dua'])) / 2 * 0.025;
      $p13 = (test_input($_POST['poin_3_satu']) + test_input($_POST['poin_3_dua'])) / 2 * 0.03;
      $p14 = (test_input($_POST['poin_4_satu']) + test_input($_POST['poin_4_dua'])) / 2 * 0.03;
      $p15 = (test_input($_POST['poin_5_satu']) + test_input($_POST['poin_5_dua'])) / 2 * 0.03;
      $p16 = (test_input($_POST['poin_6_satu']) + test_input($_POST['poin_6_dua'])) / 2 * 0.03;
      $p17 = (test_input($_POST['poin_7_satu']) + test_input($_POST['poin_7_dua'])) / 2 * 0.03;
      $p21 = (test_input($_POST['poin_8_satu']) + test_input($_POST['poin_8_dua'])) / 2 * 0.05;
      $p31 = (test_input($_POST['poin_9_satu']) + test_input($_POST['poin_9_dua'])) / 2 * 0.1;
      $p41 = (test_input($_POST['poin_10_satu']) + test_input($_POST['poin_10_dua'])) / 2 * 0.1;
      $p42 = (test_input($_POST['poin_11_satu']) + test_input($_POST['poin_11_dua'])) / 2 * 0.1;
      $p43 = (test_input($_POST['poin_12_satu']) + test_input($_POST['poin_12_dua'])) / 2 * 0.2;
      $p44 = (test_input($_POST['poin_13_satu']) + test_input($_POST['poin_13_dua'])) / 2 * 0.1;
      $p51 = (test_input($_POST['poin_14_satu']) + test_input($_POST['poin_14_dua'])) / 2 * 0.05;
      $p52 = (test_input($_POST['poin_15_satu']) + test_input($_POST['poin_15_dua'])) / 2 * 0.1;
    }
    $total =  $p11 + $p12 + $p13 + $p14 + $p15 + $p16 + $p17 +
              $p21 +
              $p31 +
              $p41 + $p42 + $p43 + $p44 +
              $p51 + $p52;
    echo "<script type='text/javascript'>alert('halo $usr -> $total!');</script>";
  }

?>
