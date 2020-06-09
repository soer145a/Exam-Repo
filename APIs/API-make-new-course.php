<?php
include_once('../DB_Connect/connection.php');
$apiCourseContent = new stdClass();
$apiCourseContent->introduction = "<p>INTRODUCTION FROM API</p>";//$_POST['']; //introduction string here!
$apiCourseContent->example = "<p>EXAMPLE FROM API</p>";//$_POST['']; //Example string here! 
$apiCourseContent->summery = "<p>SUMMERY FROM API</p>";//$_POST['']; //summery string here!
$apiCourseContent->shortDescription = "<p>SHORT DESCRIPTION FROM API</p>";//$_POST['']; //Short description string here!
$apiCourseContent->quiz = new stdClass();
$apiCourseContent->quiz->question = "API QUESTION";//$_POST['']; //Question here!
$apiCourseContent->quiz->answer_1 = "API ANSWER_1";//$_POST['']; //answer_1 here, this is the correct answer!
$apiCourseContent->quiz->answer_2 = "API ANSWER_2";//$_POST['']; //answer_2 here, this is a wrong answer!
$apiCourseContent->quiz->answer_3 = "API ANSWER_3";//$_POST['']; //answer_3 here, this is a wrong answer!
$apiCourseContent->quiz->answer_4 = "API ANSWER_4";//$_POST['']; //answer_4 here, this is a wrong answer!

$apiCourseName = "API test name";//$_POST['']; // Course name here!
$sApiCourseContent = json_encode($apiCourseContent);
echo $sApiCourseContent;
$sql = "INSERT INTO courses (courseName,courseContent)
VALUES ('$apiCourseName', '$sApiCourseContent')";
$result = $conn->query($sql);