<?php
include_once('../DB_Connect/connection.php');

$sTopicContent = $_POST['topicContent'];
$sTopicName = $_POST['topicName'];

echo $sTopicName;
echo $sTopicContent; 

$sql = "INSERT INTO topics (topicName,topicontent)
VALUES ('$sTopicName', '$sTopicContent')";
$result = $conn->query($sql);