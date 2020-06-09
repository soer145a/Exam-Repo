<?php
include_once('../DB_Connect/connection.php');
$sID = $_GET['topicID'];
$sql = "SELECT topicContent, topicName FROM topics WHERE topicID = $sID";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $jTopicContent = json_decode($row['topicContent']);
        $oTopic = new stdClass();
        $oTopic->topicName = $row['topicName'];
        $oTopic->topicContent= $jTopicContent;
        echo json_encode($oTopic);
    }
}else{
    echo '0 results';
}