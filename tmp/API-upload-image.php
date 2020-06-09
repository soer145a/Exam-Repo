<?php


// var_dump($_FILES);
// var_dump($_SERVER['DOCUMENT_ROOT'] );

// echo json_encode($_FILES);

// Allowed extentions.
$allowedExts = array("gif", "jpeg", "jpg", "png");

// Get filename.
$temp = explode(".", $_FILES["file"]["name"]);

// Get extension.
$extension = end($temp);

$path =  getcwd();

// An image check is being done in the editor but it is best to
// check that again on the server side.
// Do not use $_FILES["file"]["type"] as it can be easily forged.
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

if ((($mime == "image/gif")
|| ($mime == "image/jpeg")
|| ($mime == "image/pjpeg")
|| ($mime == "image/x-png")
|| ($mime == "image/png"))
&& in_array($extension, $allowedExts)) {
    // Generate new random name.
    $name = sha1(microtime()) . "." . $extension;

    // Save file in the uploads folder. 
    //THIS SHOULD REALLY FIRST BE DONE WHEN USER SAVE CONTENT - MOVE TO DIFFERENT API.
    //MOVE THIS TO A TMP FOLDER
    move_uploaded_file($_FILES["file"]["tmp_name"], getcwd()."/". $name);

    // Generate response.
    $response = new StdClass;
    $response->link = "./tmp/". $name;
    echo stripslashes(json_encode($response));
}