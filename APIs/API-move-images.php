<?php

//GET THE FILE FROM A POST METHOD
$sFiles = $_POST['images'];

$aFiles = json_decode($sFiles);

var_dump($aFiles);

$dir = '../tmp/';

$aTmpFiles = scandir($dir, 1);

for($i = 0; $i < count($aFiles); $i++) {
    echo "yderste loop ".$i;
    for($j = 0; $j < count($aTmpFiles); $j++ ) {
        echo "inderste loop ".$j;
      if($aFiles[$i] == $aTmpFiles[$j]) {
        $currentFilePath = "../tmp/";
        $fileToMove = $currentFilePath.$aFiles[$i];
        echo "Test";
        echo $fileToMove;

        $newFilePath = "../images/";
        rename($fileToMove, $newFilePath.$aFiles[$i]);
      }
    }
  };



