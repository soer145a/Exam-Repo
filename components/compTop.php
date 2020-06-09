<?php
        if(isset($_SESSION['loginStatus'])){
          $htmlOutput = "<a href='profile.php' data-navtag='profile' onclick='setSessionData(this)'><button class='btn-primary'>PROFILE</button></a>
          <a href='logout.php' data-navtag='index' onclick='setSessionData(this)'><button class='btn-tertiary'>LOG OUT</button></a>";
        }else{
          $htmlOutput = "<a href='signup.php' data-navtag='index' onclick='setSessionData(this)'><button class='btn-primary'>SIGN UP</button></a>
          <a href='login.php' data-navtag='index' onclick='setSessionData(this)'><button class='btn-tertiary'>LOG IN</button></a>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Teko:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link
      href="node_modules/froala-editor/css/froala_editor.pkgd.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="node_modules/froala-editor/css/plugins/image.min.css"
      rel="stylesheet"
      type="text/css"
    />
  <title>DB Academy</title>
  <!-- <link rel="stylesheet" href="main.css" /> -->
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="course.css" /> <!-- 27/04/20 - 15.35 - Daniel har tilføjet ref til course.css -->
  <link rel="stylesheet" href="signup.css" /> <!-- 04/05/20 - 12.35 - Daniel har tilføjet ref til signup.css -->
  <link rel="stylesheet" href="login.css" /> <!-- 04/05/20 - 12.35 - Daniel har tilføjet ref til login.css -->
  <link rel="stylesheet" href="glossary.css" /> <!-- 06/05/20 - 15.35 - Daniel har tilføjet ref til syllabus.css -->
  <link rel="stylesheet" href="admin.css" /> <!-- 19/05/20 - 19.09 - Mikkel har tilføjet ref til admin.css -->
  <link rel="stylesheet" href="profile.css" /> <!-- 20/05/20 - 19.09 - Daniel har tilføjet ref til profile.css -->
</head>

<body>
  <header>
    <a href="index.php" data-navtag="logo" onclick="setSessionData(this)">
      <img src="assets/logo.svg" alt="logo" />
    </a>
    <nav>
      <a href="index.php" data-navtag="index" onclick="setSessionData(this)">HOME</a>
      <a href="glossary.php" data-navtag="glossary" onclick="setSessionData(this)">GLOSSARY</a>
      <a href="course.php" data-navtag="course" onclick="setSessionData(this)">COURSE</a>
    </nav>
    <div>
      <?= $htmlOutput ?>
    </div>
  </header>