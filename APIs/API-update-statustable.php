<?php
include_once('../DB_Connect/connection.php');
include_once('../DB_Connect/procedures.php');

session_start();
$userID = $_SESSION['userID'];
$courseID = $_GET['courseID'];
$sTopic = $_GET['topic'];

$updateUserCourseTopic = str_replace('::topic::',$sTopic, $updateUserCourseTopic);
$updateUserCourseTopic = str_replace('::userID::',$userID, $updateUserCourseTopic);
$updateUserCourseTopic = str_replace('::courseID::',$courseID, $updateUserCourseTopic);

$sql = $updateUserCourseTopic;
$result = $conn->query($sql);
echo $result;