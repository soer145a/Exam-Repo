<?php
include_once('../DB_Connect/connection.php');
$sID = $_GET['courseID'];
$sql = "SELECT topicContent FROM topics WHERE topicID = $sID";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
   $jData = json_decode($row['topicContent']);
   echo json_encode($jData->introduction);
    }
}else{
    echo '0 results';
}