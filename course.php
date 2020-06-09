<?php
session_start();
include_once('DB_Connect/connection.php');
include_once('DB_Connect/procedures.php');
$sql = "SELECT topicID,topicName,topicContent FROM topics";
$result = $conn->query($sql);

if (isset($_SESSION['loginStatus'])) {
  $getUserProgress = str_replace("::uID::", $_SESSION['userID'], $getUserProgress);
  $sqlUserProgress = $getUserProgress;
  $resultUserProgress = $conn->query($sqlUserProgress);
  $aProgressArray = [];
  if ($resultUserProgress->num_rows > 0) {
    // output data of each row
    while ($row = $resultUserProgress->fetch_assoc()) {
      $newObj = new stdClass;
      $newObj->status = $row['statusVariabel'];
      $newObj->courseName = $row['topicName'];
      array_push($aProgressArray, $newObj);
    }
  } else {
    echo "0 results";
  }
}



include_once('components/compTop.php');

?>
<!-- 27/04/20 - 15.35 - Daniel har indsat diverse div -->
<span id="background" class="margin-top">
  <img src="assets/Polygon 1.svg" alt="" />
  <img src="assets/Polygon 2.svg" alt="" />
</span>
<main id="courseMain">
  <div id="sideContent">
    <h1>Course: Learning relational databases</h1>
    <div id="divContentContainer">
      <div id="divContent">
        <div id="mainContent">
          <h2>To start a course:</h2>
          <br>
          <p>Use the navigation to the right</p>
          <br>
          <p>OR</p>
          <br>
          <p>Use the next button to start from the begining</p>
        </div>
        <div id="divNavigationButtons">
          <?php include_once('components/navigation.html') ?>
          <!-- 27/04/20 - 15.35 - Daniel har indsat next og back button comp her -->
        </div>
      </div>

      <div id="divNavigation">
        <?php

        if ($result->num_rows > 0) {
          // output data of each row
          $index = 2;
          while ($row = $result->fetch_assoc()) {

            $sData = json_decode($row['topicContent']);

            echo '<button onclick="showOptions(\'contentOptions' . $row['topicID'] . '\')" class="btnDropdown">' . $row['topicName'] . ' <i class="fa fa-chevron-down" style="font-size:24px"></i></button>
            <div id="contentOptions' . $row['topicID'] . '" class="dropdown-content">
                <a id="' . $index . '" onclick="fetchIntroduction(\'' . $row['topicID'] . '\'); changePlacement(' . $index++ . ');">' . $sData->shortDescription . '</a>
                <a id="' . $index . '" onclick="fetchExample(\'' . $row['topicID'] . '\'); changePlacement(' . $index++ . ');">Example</a>
                <a id="' . $index . '" onclick="fetchSummery(\'' . $row['topicID'] . '\'); changePlacement(' . $index++ . ');">Summery</a>
                <a id="' . $index . '" onclick="fetchQuiz(\'' . $row['topicID'] . '\'); changePlacement(' . $index++ . ');">Quiz</a>
            </div>';
          }
        } else {
          echo "0 results";
        }

        $conn->close();
        ?>

      </div>
    </div>
  </div>
  <div id="divSearchResult" class="searchResult">
  </div>
</main>


<?php
include_once('components/compBottom.php');
?>
<script>
  var obj = <?php echo json_encode($aProgressArray); ?>;
  setBookmark(obj);
</script>