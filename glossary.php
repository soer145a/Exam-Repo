<?php
session_start();
include_once('components/compTop.php');

$sData = file_get_contents('glossary.json');
$jData = json_decode($sData);

$divWithGlossary = "";

foreach ($jData as $key => $value) {
    $divWithGlossary .= "<div><b>$key:</b> $value</div>";
}

?>
<span id="background" class="margin-top">
    <img src="assets/Polygon 1.svg" alt="" />
    <img src="assets/Polygon 2.svg" alt="" />
</span>
<main id="glossaryMainContent">
    <!-- 04/05/20 - 13.30 - Daniel har lavet små ændringer til formen.  -->
<section>
<h1>GLOSSARY</h1>
    <div class="container">
        <?= $divWithGlossary ?>
    </div>
    </section>
</main>
<?php
include_once('components/compBottom.php');
?>