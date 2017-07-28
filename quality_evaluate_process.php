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

    $x1 = (test_input($_POST['poin_1_satu']) + test_input($_POST['poin_1_dua']))   ;
    $x2 = (test_input($_POST['poin_2_satu']) + test_input($_POST['poin_2_dua']))   ;
    $x3 = (test_input($_POST['poin_3_satu']) + test_input($_POST['poin_3_dua']))   ;
    $x4 = (test_input($_POST['poin_4_satu']) + test_input($_POST['poin_4_dua']))   ;
    $x5 = (test_input($_POST['poin_5_satu']) + test_input($_POST['poin_5_dua']))   ;
    $x6 = (test_input($_POST['poin_6_satu']) + test_input($_POST['poin_6_dua']))   ;
    $x7 = (test_input($_POST['poin_7_satu']) + test_input($_POST['poin_7_dua']))   ;
    $x8 = (test_input($_POST['poin_8_satu']) + test_input($_POST['poin_8_dua']))   ;
    $x9 = (test_input($_POST['poin_9_satu']) + test_input($_POST['poin_9_dua']))   ;
    $x10 = (test_input($_POST['poin_10_satu']) + test_input($_POST['poin_10_dua'])) ;
    $x11 = (test_input($_POST['poin_11_satu']) + test_input($_POST['poin_11_dua'])) ;
    $x12 = (test_input($_POST['poin_12_satu']) + test_input($_POST['poin_12_dua'])) ;
    $x13 = (test_input($_POST['poin_13_satu']) + test_input($_POST['poin_13_dua'])) ;
    $x14 = (test_input($_POST['poin_14_satu']) + test_input($_POST['poin_14_dua'])) ;
    $x15 = (test_input($_POST['poin_15_satu']) + test_input($_POST['poin_15_dua'])) ;

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
  date_default_timezone_set("Asia/Bangkok");
  $time = date('Y-m-d H:i:s');
  $periode = ceil(date('d') / 10);
  echo "<script type='text/javascript'>alert('$periode!');</script>";
  $query_variable_total = "select agent_performance_1.total as nilai_1,
                           agent_performance_2.total as nilai_2 from(agent_performance_1 inner join
                           agent_performance_2 on agent_performance_1.username = agent_performance_2.username)
                           where agent_performanace_1 = '$usr'";
  $result = mysqli_query($conn, $query_variable_total);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nilai_1 = $row['nilai_1'];
    $nilai_2 = $row['nilai_2'];
  }
  if ($periode == 1){
    $query_update_agent_performance =  "update agent_performance_1
                                        set date='$time' ,p1=$x1 , p2=$x2 , p3=$x3 , p4=$x4 , p5=$x5 ,
                                        p6=$x6 , p7=$x7 , p8=$x8 , p9=$x9 , p10=$x10 , p11=$x11 ,
                                        p12=$x12 , p13=$x13 , p14=$x14 , p15=$x15 , total=$total
                                        where username='$usr'";

    echo "<script type='text/javascript'>alert('$total!');</script>";
    $query_update_agent_performance_agent =  "update agent
                                              set performance=$total, last_update_performance='$time'
                                              where username='$usr'";
  }
  elseif($periode == 2){
    $query_update_agent_performance =  "update agent_performance_2
                                        set date='$time' ,p1=$x1 , p2=$x2 , p3=$x3 , p4=$x4 , p5=$x5 ,
                                        p6=$x6 , p7=$x7 , p8=$x8 , p9=$x9 , p10=$x10 , p11=$x11 ,
                                        p12=$x12 , p13=$x13 , p14=$x14 , p15=$x15 , total=$total
                                        where username='$usr'";

    $total_rata2 = ($nilai_1 + $total) / 2;
    echo "<script type='text/javascript'>alert('$total_rata2 -> $nilai_1!');</script>";
    $query_update_agent_performance_agent =  "update agent
                                              set performance=$total_rata2, last_update_performance='$time'
                                              where username='$usr'";
  }
  elseif($periode == 3){
    $query_update_agent_performance =  "update agent_performance_3
                                        set date='$time' ,p1=$x1 , p2=$x2 , p3=$x3 , p4=$x4 , p5=$x5 ,
                                        p6=$x6 , p7=$x7 , p8=$x8 , p9=$x9 , p10=$x10 , p11=$x11 ,
                                        p12=$x12 , p13=$x13 , p14=$x14 , p15=$x15 , total=$total
                                        where username='$usr'";

    $total_rata2 = ($nilai_1 +$nilai_2 + $total) / 3;
    echo "<script type='text/javascript'>alert('$total_rata2 -> $nilai_1 && $nilai_2!');</script>";
    $query_update_agent_performance_agent =  "update agent
                                              set performance=$total_rata2, last_update_performance='$time'
                                              where username='$usr'";
  }


  $query_update_agent_performance_agent =  "update agent
                                            set performance=$total, last_update_performance='$time'
                                            where username='$usr'";

  //update performance in agent_performance
  if ($conn->query($query_update_agent_performance) === TRUE)  {
    echo "<script type='text/javascript'>alert('agent performance updated!');</script>";
  } else {
    echo "<script type='text/javascript'>alert('agent performance not updated!');</script>";
  }
  //update agent table
  if ($conn->query($query_update_agent_performance_agent) === TRUE)  {
    echo "<script type='text/javascript'>alert('agent performance table agent updated!');</script>";
  } else {
    echo "<script type='text/javascript'>alert('agent performance table agent not updated!');</script>";
  }
  header("Location: quality_evaluate.php");
?>
