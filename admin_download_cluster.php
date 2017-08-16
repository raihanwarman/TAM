<?php

$conn = new mysqli("localhost", "root", "root", "TAM");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$setSql = "select user.nama as nama, agent.position as posisi, agent.sales_agree as sales_agree,
           agent.sales_ps as sales_ps, agent.performance as qm_score, agent.pnp_score as pnp_score,
           agent.attitude_score as attitude_score, agent.total_score as total_score, agent.cluster as cluster
           from (agent inner join user on agent.username = user.username) where agent.role = 'sales'";
$setRec = mysqli_query($conn, $setSql);

$columnHeader = '';
$columnHeader = "Nama" . "\t" . "Posisi" . "\t" . "Sales Agree" . "\t" . "Sales PS" . "\t" . "QM Score"
                 . "\t" . "PNP Score" . "\t" . "Attitude Score" . "\t" . "Total Score" . "\t" . "Cluster"
                  . "\t";

$setData = '';

while ($rec = mysqli_fetch_row($setRec)) {
    $rowData = '';
    foreach ($rec as $value) {
        $value = '"' . $value . '"' . "\t";
        $rowData .= $value;
    }
    $setData .= trim($rowData) . "\n";
}


header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=User_Detail_Report.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo ucwords($columnHeader) . "\n" . $setData . "\n";

?>
