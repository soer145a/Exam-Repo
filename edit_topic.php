<?php 

$id = $_GET["id"];

include_once('components/compTop.php');
?>

<span id="background" class="margin-top">
      <img src="assets/Polygon 1.svg" alt="" />
      <img src="assets/Polygon 2.svg" alt="" />
    </span>
    <main id="edit">
      <h1>Edit topic - [TOPIC NAME]</h1>
      <div id="sectionwrapper">
        <section>
          <nav>
            <button
              class="active_tab"
              data-activetab="topicName"
              onclick="switchActiveEditTab(this)"
            >
              Topic title
            </button>
            <button
              data-activetab="shortDescription"
              onclick="switchActiveEditTab(this)"
            >
              Short description
            </button>
            <button
              data-activetab="introduction"
              onclick="switchActiveEditTab(this)"
            >
              Introduction
            </button>
            <button
              data-activetab="example"
              onclick="switchActiveEditTab(this)"
            >
              Example
            </button>
            <button
              data-activetab="summery"
              onclick="switchActiveEditTab(this)"
            >
              Summery
            </button>
            <button data-activetab="quiz" onclick="switchActiveEditTab(this)">
              Quiz
            </button>
            <div>
              <a href="edit_course.php"
                ><button class="btn-quaternary">CANCEL</button></a
              >
              <button onclick="updateTopic(<?php echo $id?>)" class="btn-primary">
                SAVE CONTENT
              </button>
            </div>
          </nav>
        </section>
        <section>
          <div id="topicName">
            <label for="">Topic title:</label>
            <input type="text" placeholder="Type in the topic title" />
          </div>
          <div id="shortDescription" style="display: none;">
            <label for="">Short Description:</label>
            <input type="text" placeholder="Type in a short description for the topic" />
          </div>
          <div id="quiz" style="display: none;">
            <label for="">Quiz question:</label>
            <input
              data-quiz="question"
              type="text"
              placeholder="Type in your quiz question"
            />
            <label for="">Enter the correct answer:</label>
            <input
              data-quiz="answer_1"
              type="text"
              placeholder="Type in the correct answer"
            />
            <label for="">Enter a wrong answer:</label>
            <input
              data-quiz="answer_2"
              type="text"
              placeholder="Type in a wrong answer"
            />
            <label for="">Enter a wrong answer:</label>
            <input
              data-quiz="answer_3"
              type="text"
              placeholder="Type in a wrong answer"
            />
            <label for="">Enter a wrong answer:</label>
            <input
              data-quiz="answer_4"
              type="text"
              placeholder="Type in a wrong answer"
            />
          </div>
          <div id="froala-editor" style="display: none;"></div>
        </section>
      </div>
    </main>
    <?php
    include_once('components/compBottom.php');
    ?>
    <script>
        initEditor();
        fetchTopicContent(<?php echo $id ?>)
    </script>
