<?php
include_once('../DB_Connect/connection.php');
include_once('../DB_Connect/procedures.php');

$topicID = $_GET["topicID"];

$deleteTopic = str_replace("::uID::",$topicID, $deleteTopic);

// echo $deleteTopic;

$sql = $deleteTopic;

$result = $conn->query($sql);