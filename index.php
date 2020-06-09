<?php 
session_start();
include_once('DB_Connect/connection.php');
include_once('DB_Connect/procedures.php');

if(isset($_SESSION['loginStatus'])) {
  $sName = $_SESSION['firstName'];
  $getUserProgress = str_replace("::uID::",$_SESSION['userID'],$getUserProgress);
  $sql = $getUserProgress;
  $result = $conn->query($sql);
  $aProgressArray = [];
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc() ) {
        $newObj = new stdClass;
        $newObj->status = $row['statusVariabel']; 
        $newObj->courseName = $row['topicName'];
        array_push($aProgressArray, $newObj);
    }
  } else {
          echo "0 results";
  }
}
$conn->close();
include_once('components/compTop.php');
?>

<div id="banner">
      <img src="assets/banner_element1.svg" alt="banner element">
      <img src="assets/banner_element2.svg" alt="banner element">
      <img src="assets/banner_element3.svg" alt="banner element">
      <div id="bannerTxt">
        <?php 
          if(isset($_SESSION["loginStatus"])) {
            echo "<h1>Hi ".$sName." - Ready to learn about Relational Databases? Jump right in</h1>";
          } else {
            echo "<h1>Hello - Ready to learn about Relational Databases? Jump right in</h1>";
          }
        ?>
        <a href="course.php" data-navtag="course" onclick="setSessionData(this)"><button class="btn-secondary">BEGIN COURSE</button></a>
      </div>
        
    </div>
    <span id="background">
      <img src="assets/Polygon 1.svg" alt="" />
      <img src="assets/Polygon 2.svg" alt="" />
    </span>
    <main id="indexPage">
      <section id="learn"class="sectionwrapper">
        <h2>LEARN</h2>
        <div class="container">
          <h3>Learn about relational databases</h3>
          <p>
          A relational database is a database consisting of two or more tables that each are related to one or more of the other tables in the database. They create relationships between one another by referring to columns, also called attributes, in different tables.
          </p>
          <a href="course.php" data-navtag="course" onclick="setSessionData(this)"><button class="btn-secondary">BEGIN COURSE</button></a>
        </div>
      </section>
      <section id="my_progress" class="sectionwrapper">
        <h2>MY PROGRESS</h2>
        <div class="container">
          <?php 
           if(!isset($_SESSION['loginStatus'])) {
            echo "<div class='login_signup'>
                    <a href='signup.php' data-navtag='index' onclick='setSessionData(this)'><button class='btn-primary'>SIGN UP</button></a>
                    <h3>OR</h3>
                    <a href='login.php' data-navtag='index' onclick='setSessionData(this)'><button class='btn-tertiary'>LOG IN</button></a>
                  </div>";
           }
          ?>
        <div id="totalProgress">
          <?php
          
           if(isset($_SESSION['loginStatus'])){
            $amountOfCourses = 0;
            $totalProgress = 0;
             foreach ($aProgressArray as $obj){$amountOfCourses++; $totalProgress = $totalProgress + $obj->status;}
             $totalDivider = $amountOfCourses * 4;
             $percentages = $totalProgress / $totalDivider * 100;
             $percentages = round($percentages);
             echo "<h2>Total Progress!</h2>
             <svg height='20' width='20' viewBox='0 0 20 20'>
               <circle r='10' cx='10' cy='10' fill='var(--color-five)'/>
               <circle r='5' cx='10' cy='10' fill='transparent' stroke='var(--color-six)' stroke-dasharray='calc($percentages * 31.42 / 100) 31.42' stroke-width='10'
               transform='rotate(-90) translate(-20)'/>
               <circle r='8' cx='10' cy='10' fill='white'/>
               <text x='5' y='11.5' class='svgText'>$percentages%</text>
             </svg>";
           }
          ?>
                          
                        
          </div>
        <div id="individualTopicProgress">
          <?php
            if(isset($_SESSION['loginStatus'])) {
                foreach ($aProgressArray as $obj){
                  $courseName = $obj->courseName;
                  $progress = $obj->status;
                  $percentages = $progress * 100 / 4;
                  echo "<div class='iProgressItem'>
                          <p>$courseName</p>
                          <svg height='20' width='20' viewBox='0 0 20 20'>
                            <circle r='10' cx='10' cy='10' fill='var(--color-five)'/>
                            <circle r='5' cx='10' cy='10' fill='transparent' stroke='var(--color-six)' stroke-dasharray='calc($percentages * 31.42 / 100) 31.42' stroke-width='10'
                            transform='rotate(-90) translate(-20)'/>
                            <circle r='8' cx='10' cy='10' fill='white'/>
                            <text x='5' y='11.5' class='svgText'>$progress / 4</text>
                          </svg>
                        </div>";
                }
              };
          ?>
        </div>
        
        </div>
      </section>
    </main>

    <?php 
include_once('components/compBottom.php');
?>