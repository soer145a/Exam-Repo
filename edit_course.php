<?php 
include_once('DB_Connect/connection.php');

$sql = "SELECT * FROM topics";

$result = $conn->query($sql);

$oTopics = new stdClass;



for($i = 0; $i < $result->num_rows; $i++) {
  $oTopics->$i = $result->fetch_assoc();
};
include_once('components/compTop.php');
?>
    <div class="modalBackground">
      <div class="modalWindow">
        <h2>DELETE TOPIC</h2>
        <h3>Are you sure you want to delete this topic?</h3>
        <div>
          <button class="btn-quaternary" onclick="showModal(this)">CANCEL</button>
          <button class="btn-primary" onclick="deleteTopic(this)">OK</button>
        </div>
      </div>
    </div>
    <span id="background" class="margin-top">
      <img src="assets/Polygon 1.svg" alt="" />
      <img src="assets/Polygon 2.svg" alt="" />
    </span>
    <main id="topic">
      <h1>Course Topics</h1>
      <div id="sectionwrapper">
        <section>
        <?php 
            for($i = 0; $i < $result->num_rows; $i++) {
              echo '<div class="topic" data-id="'.$oTopics->$i["topicID"].'">
                      <h3>'.$oTopics->$i["topicName"].'</h3>
                      <a href="edit_topic.php?id='.$oTopics->$i["topicID"].'">
                        <button class="btn-primary">EDIT</button>
                      </a>
                      <button class="btn-quaternary" onclick="showModal(this)">DELETE</button>
                    </div>';
            };
          ?>
        </section>
        <section>
          <a href="create_topic.php">
            <button class="btn-primary">CREATE TOPIC</button>
          </a>
        </section>
      </div>
    </main>
    
<?php 
include_once('components/compBottom.php');
?>
