<?php
header('Content-Type: application/json');

$sData = file_get_contents('../glossary.json');

$sDataLowerd = strtolower($sData);

echo $sDataLowerd;

