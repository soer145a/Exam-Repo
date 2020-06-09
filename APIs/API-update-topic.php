<?php
include_once('../DB_Connect/connection.php');
$sID = $_GET['topicID'];

$sTopicName = $_POST['topicName'];
$sTopicContent = $_POST['topicContent'];

$sql = "UPDATE topics SET topicName='$sTopicName', topicContent='$sTopicContent'WHERE topicID=$sID";

$result = $conn->query($sql);

