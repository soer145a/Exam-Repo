// 25-05-2020 - Mikkel Start
let showModalWindow = 0;
let editor;
let aUploadedImages = [];
let oTopicData = {
  shortDescription: "",
  introduction: "",
  example: "",
  summery: "",
  quiz: {
    question: "",
    answer_1: "",
    answer_2: "",
    answer_3: "",
    answer_4: "",
  },
};

function initEditor() {
  editor = new FroalaEditor("#froala-editor", {
    toolbarButtons: [
      [
        "bold",
        "italic",
        "underline",
        "paragraphFormat",
        "formatOL",
        "formatUL",
      ],
      ["insertHTML", "undo", "redo", "html", "insertLink", "insertImage"],
    ],
    imageUploadURL: "tmp/API-upload-image.php",
    height: "calc(50vh - 42px)",
    events: {
    'image.uploaded': function (response) {
      let aSubstrings = response.split('tmp/');
      aUploadedImages.push(aSubstrings[1]);
    }
  },
  });
}

// 25-05-2020 - Mikkel Slut

/* ---------------- 29-4-2020 Mikkel Start*/
window.addEventListener("load", clearElementClass);
/* ---------------- 29-4-2020 Mikkel Slut*/

let mainArea = document.querySelector("#mainContent");
let infoHTMLBackup;
let placement = 1;
function editProfile() {
  console.log("EDIT");
  infoHTMLBackup = document.querySelector("#profileContent").innerHTML;
  let uFirstName = document.querySelector("#pFirstName").textContent;
  let uLastName = document.querySelector("#pLastName").textContent;
  let uEmail = document.querySelector("#pEmail").textContent;
  let uUsername = document.querySelector("#pUsername").textContent;
  let uPassword = document.querySelector("#hiddenPassword").value;
  let uID = document.querySelector("#hiddenID").value;
  document.querySelector(
    "#profileContent"
  ).innerHTML = `<form id="frmEditProfile" action="profile.php" method="post">
  <label><p>NEW First Name:</p>
      <input type="text" name="uFirstName" placeholder="John" value="${uFirstName}">
  </label>
  <label><p>NEW Last Name:</p>
      <input type="text" name="uLastName" placeholder="Smith" value="${uLastName}">
  </label>
  <label><p>NEW Email Address:</p>
      <input type="email" name="uEmail" placeholder="john@smith.com" value="${uEmail}">
  </label>
  <label for=""> <p> NEW Username:</p>
  <input type="text" name="uUsername" placeholder="Username" value="${uUsername}">
</label>
<label for=""><p>NEW Password:</p>
  <input type="text" name="uPassword" placeholder="XXXXX" value="${uPassword}">
</label>

  <input type="hidden" name="uID"  value="${uID}">

   <br>
  <button class="btn-primary" type="submit" >SAVE</button>
  <button class="btn-quaternary" onclick="cancelEditing(); return false;">Cancel</button>
  </form>`;
  console.log(infoHTMLBackup);
}
function cancelEditing() {
  console.log("X");
  document.querySelector("#profileContent").innerHTML = infoHTMLBackup;
}
function openDeleteModal() {
  document.querySelector("#deleteModalWindow").style.opacity = 1;
  document.querySelector("#deleteModalWindow").style.pointerEvents = "all";
  document.querySelector("#deleteModalContent").style.opacity = 1;
  document.querySelector("#deleteModalContent").style.pointerEvents = "all";
}
function closeDeleteModal() {
  document.querySelector("#deleteModalWindow").style.opacity = 0;
  document.querySelector("#deleteModalContent").style.opacity = 0;
  document.querySelector("#deleteModalWindow").style.pointerEvents = "none";
  document.querySelector("#deleteModalContent").style.pointerEvents = "none";
}
function showOptions(stringDivName) {
  let dropdowns = document.querySelectorAll(".dropdown-content");
  dropdowns.forEach((item) => {
    item.classList.remove("show");
  });

  if (document.getElementById(stringDivName).classList.contains("show")) {
    document.getElementById(stringDivName).classList.remove("show");
  } else {
    document.getElementById(stringDivName).classList.add("show");
  }
}

function setBookmark(obj) {
  var i = 0;
  obj.forEach((item) => {
    i++;

    switch (item.courseName) {
      case "Relational Database":
        var childElements = document.getElementById("contentOptions" + i)
          .children;
        var childElement = childElements[item.status - 1];
        childElement.insertAdjacentHTML(
          "beforeend",
          '<i class="fa fa-bookmark"></i>'
        );
        break;
      case "Normalization":
        var childElements = document.getElementById("contentOptions" + i)
          .children;
        var childElement = childElements[item.status - 1];
        childElement.insertAdjacentHTML(
          "beforeend",
          '<i class="fa fa-bookmark"></i>'
        );
        break;
      case "Entity Relationship Diagram (ERD)":
        var childElements = document.getElementById("contentOptions" + i)
          .children;
        var childElement = childElements[item.status - 1];
        childElement.insertAdjacentHTML(
          "beforeend",
          '<i class="fa fa-bookmark"></i>'
        );
        break;
      case "SQL and Datamanipulation":
        var childElements = document.getElementById("contentOptions" + i)
          .children;
        var childElement = childElements[item.status - 1];
        childElement.insertAdjacentHTML(
          "beforeend",
          '<i class="fa fa-bookmark"></i>'
        );
        break;
      case "Installation and XAMPP":
        var childElements = document.getElementById("contentOptions" + i)
          .children;
        var childElement = childElements[item.status - 1];
        childElement.insertAdjacentHTML(
          "beforeend",
          '<i class="fa fa-bookmark"></i>'
        );
        break;
      case "Connecting to the Web":
        var childElements = document.getElementById("contentOptions" + i)
          .children;
        var childElement = childElements[item.status - 1];
        childElement.insertAdjacentHTML(
          "beforeend",
          '<i class="fa fa-bookmark"></i>'
        );
        break;
    }
  });

  // let bookmarked = document.querySelectorAll(".bookmarked");
  // bookmarked.forEach((item) => {
  //   item.classList.remove("bookmarked");
  // });
  // var toBeBookmarked = document.getElementById($progress+1);
  // toBeBookmarked.classList.add("bookmarked");
}

// 27/04/20 - 17.15 - Daniel har indsat functionskaldet setActive.call(this) for at vise hvilket nav element der er aktivt
function setActive(placeCounter) {
  let actives = document.querySelectorAll(".navActive");
  actives.forEach((item) => {
    item.classList.remove("navActive");
  });
  document.getElementById(placeCounter).classList.add("navActive");
}

async function fetchIntroduction(ID) {
  console.log("FETCH INTRODUCTION ON COURSE" + ID);
  updateProgressTable(ID, 1);

  console.log(placement);
  let connection = await fetch(
    `APIs/API-fetch-introductions.php?courseID=${ID}`
  );
  let sData = await connection.json();
  console.log(sData);

  mainArea.innerHTML = sData;
}
async function fetchExample(ID) {
  updateProgressTable(ID, 2);
  console.log("FETCH EXAMPLE ON COURSE" + ID);

  let connection = await fetch(`APIs/API-fetch-examples.php?courseID=${ID}`);
  let sData = await connection.json();
  console.log(sData);
  mainArea.innerHTML = sData;
}
async function fetchSummery(ID) {
  console.log("FETCH SUMMERY ON COURSE" + ID);
  updateProgressTable(ID, 3);
  let connection = await fetch(`APIs/API-fetch-summery.php?courseID=${ID}`);
  let sData = await connection.json();
  console.log(sData);
  mainArea.innerHTML = sData;
}
async function fetchQuiz(ID) {
  console.log("FETCH QUIZ ON COURSE" + ID);
  updateProgressTable(ID, 4);
  let connection = await fetch(`APIs/API-fetch-quiz.php?courseID=${ID}`);
  let sData = await connection.json();
  let htmlBluePrintQuiz = await fetch(`blueprints/quizHTMLElement.php`);
  let a = [sData.answer_1, sData.answer_2, sData.answer_3, sData.answer_4];
  var j, x, i;
  for (i = a.length - 1; i > 0; i--) {
    j = Math.floor(Math.random() * (i + 1));
    x = a[i];
    a[i] = a[j];
    a[j] = x;
  }
  let quizHtml = await htmlBluePrintQuiz.text();
  let htmlPrint = quizHtml.replace("::answer_1::", a[0]);
  htmlPrint = htmlPrint.replace("::answer_2::", a[1]);
  htmlPrint = htmlPrint.replace("::answer_3::", a[2]);
  htmlPrint = htmlPrint.replace("::answer_4::", a[3]);
  a.forEach((item, index) => {
    if (item == sData.answer_1) {
      htmlPrint = htmlPrint.replace(`::truthCheck${index + 1}::`, "true");
    } else {
      htmlPrint = htmlPrint.replace(`::truthCheck${index + 1}::`, "false");
    }
  });
  htmlPrint = htmlPrint.replace("::questionArea::", sData.question);
  mainArea.innerHTML = htmlPrint;
}
function answerQuiz(e) {
  let questionBoxes = document.querySelectorAll(".questionBox");
  questionBoxes.forEach((div) => {
    if (div == e) {
      if (div.dataset.truthcheck == "true") {
        div.classList.add("correctAnswer");
      } else {
        div.classList.add("wrongAnswer");
      }
    } else {
      div.classList.add("greyAnswer");
    }
    if (div.dataset.truthcheck == "true") {
      div.classList.add("correctAnswer");
    }
  });
}
let firstPage = mainArea.innerHTML;
function navMovementHandler(direction) {
  placement = placement + direction;
  if (placement == 0) {
    placement = placement + 1;
  }
  if (placement == 1) {
    mainArea.innerHTML = firstPage;
  }
  if (placement >= 2 && placement <= 5) {
    let fakeID = 1;
    let Options = "contentOptions" + fakeID; //Tilføjet af Daniel - 11/05/20 - 15.05 - Sørger for at den rette contentOptions div bliver vist når brugeren bruger next og back buttons til at navigere med
    switch (placement) {
      case 2:
        fetchIntroduction(fakeID);
        showOptions(Options); //Tilføjet af Daniel - 11/05/20 - 15.05 - Sørger for at den rette contentOptions div bliver vist når brugeren bruger next og back buttons til at navigere med
        break;
      case 3:
        fetchExample(fakeID);
        showOptions(Options);
        break;
      case 4:
        fetchSummery(fakeID);
        showOptions(Options);
        break;
      case 5:
        fetchQuiz(fakeID);
        showOptions(Options);
        break;
    }
  }
  if (placement >= 6 && placement <= 9) {
    let fakeID = 2;
    let Options = "contentOptions" + fakeID;
    switch (placement) {
      case 6:
        fetchIntroduction(fakeID);
        showOptions(Options);
        break;
      case 7:
        fetchExample(fakeID);
        showOptions(Options);
        break;
      case 8:
        fetchSummery(fakeID);
        showOptions(Options);
        break;
      case 9:
        fetchQuiz(fakeID);
        showOptions(Options);
        break;
    }
  }
  if (placement >= 10 && placement <= 13) {
    let fakeID = 3;
    let Options = "contentOptions" + fakeID;
    switch (placement) {
      case 10:
        fetchIntroduction(fakeID);
        showOptions(Options);
        break;
      case 11:
        fetchExample(fakeID);
        showOptions(Options);
        break;
      case 12:
        fetchSummery(fakeID);
        showOptions(Options);
        break;
      case 13:
        fetchQuiz(fakeID);
        showOptions(Options);
        break;
    }
  }
  if (placement >= 14 && placement <= 17) {
    let fakeID = 4;
    let Options = "contentOptions" + fakeID;
    switch (placement) {
      case 14:
        fetchIntroduction(fakeID);
        showOptions(Options);
        break;
      case 15:
        fetchExample(fakeID);
        showOptions(Options);
        break;
      case 16:
        fetchSummery(fakeID);
        showOptions(Options);
        break;
      case 17:
        fetchQuiz(fakeID);
        showOptions(Options);
        break;
    }
  }
  if (placement >= 18 && placement <= 21) {
    let fakeID = 5;
    let Options = "contentOptions" + fakeID;
    switch (placement) {
      case 18:
        fetchIntroduction(fakeID);
        showOptions(Options);
        break;
      case 19:
        fetchExample(fakeID);
        showOptions(Options);
        break;
      case 20:
        fetchSummery(fakeID);
        showOptions(Options);
        break;
      case 21:
        fetchQuiz(fakeID);
        showOptions(Options);
        break;
    }
  }
  if (placement >= 22 && placement <= 25) {
    let fakeID = 6;
    let Options = "contentOptions" + fakeID;
    switch (placement) {
      case 22:
        fetchIntroduction(fakeID);
        showOptions(Options);
        break;
      case 23:
        fetchExample(fakeID);
        showOptions(Options);
        break;
      case 24:
        fetchSummery(fakeID);
        showOptions(Options);
        break;
      case 25:
        fetchQuiz(fakeID);
        showOptions(Options);
        break;
    }
  }
  setActive(placement);
}

function changePlacement(placeCounter) {
  placement = placeCounter;

  setActive(placement); //Tilføjet af Daniel - 11/05/20 - 15.05 - Sørger for at det rette navigations element får active class
}

async function glossarySearch() {
  console.log("glossarySearch kørt");
  var searchBar = document.querySelector("#inputGlossarySearch");
  var searchWord = searchBar.value;
  searchWord = searchWord.toLowerCase();
  let connection = await fetch(`APIs/API-fetch-search.php`);
  let jData = await connection.json();
  searchDiv = document.getElementById("divSearchResult");
  searchDiv.innerHTML = "";
  var definition = "";

  for (x in jData) {
    if (x.includes(searchWord)) {
      definition = jData[x];
      console.log(x);
      searchDiv.innerHTML +=
        "<div><b>" +
        x.toUpperCase() +
        ": </b>" +
        definition.toUpperCase() +
        "</div>";
      searchDiv.classList.add("searchResultShow");
    }
  }
  if (searchWord.length < 1 || definition.length < 1) {
    searchDiv.innerHTML = "";
    searchDiv.classList.remove("searchResultShow");
  }
  if (searchWord.length > 1 && definition.length < 2) {
    searchDiv.innerHTML = "No result found";
    searchDiv.classList.add("searchResultShow");
  }
}
/* ---------------- 29-4-2020 Mikkel Start*/

function setSessionData(e) {
  //Get dataset on clicked element
  let sClickedNavBtn = e.dataset.navtag;
  console.log(sClickedNavBtn);

  //Store dataset value in sessionStorage
  sessionStorage.setItem("chosenPage", sClickedNavBtn);
}

function clearElementClass() {
  //Get all elements within Nav element with dataset "data-navtag"
  let aNavigationElements = document.querySelectorAll("[data-navtag]");
  //Iterate through the array of child elements and reset class to empty
  for (let i = 0; i < aNavigationElements.length; i++) {
    aNavigationElements[i].classList = "";
  }
  retrieveSessionData();
}
// 24-05-2020 - Mikkel start
function cleanUpURL() {
  let sURL = window.location.href;

  //Split the url into pieces divided by a /
  let aSplitUrl = sURL.split("/");

  //get the last element in the URL array, which will be the current page
  let sGetLastElement = aSplitUrl[aSplitUrl.length - 1];

  //Split the string (pagename.php)
  let aSplitElement = sGetLastElement.split(".");

  //Get the first element in the array which will be without .php
  let sGetFirstElement = aSplitElement[0];

  return sGetFirstElement;
}
// 24-05-2020 - Mikkel slut
function retrieveSessionData() {
  //Set chosenPage to contain saved sessionData
  let sChosenPage = sessionStorage.getItem("chosenPage");

  //Get all elements with the dataset "data-navtag"
  let aGetTopNavigationTabs = document.querySelectorAll("[data-navtag]");

  if (sChosenPage === null) {
    let currentPage = cleanUpURL();

    //Iterate through the array
    for (let i = 0; i < aGetTopNavigationTabs.length; i++) {
      console.log(i);
      //If there is a match between the page the user is on and a dataset name then apply the class active on that element
      if (aGetTopNavigationTabs[i].dataset.navtag === currentPage) {
        aGetTopNavigationTabs[i].classList = "active";
        break;
      }
    }
  } else {
    for (let i = 0; i < aGetTopNavigationTabs.length; i++) {
      //If there is a match between the sessionData and a dataset name then apply the class active on that element
      if (sChosenPage === "profile") {
        for (let i = 0; i < aGetTopNavigationTabs.length; i++) {
          aGetTopNavigationTabs[i].classList = "";
        }
        break;
      }
      if (sChosenPage === "logo") {
        document.querySelector("[data-navtag=index]").classList = "active";
        break;
      }
      if (aGetTopNavigationTabs[i].dataset.navtag === sChosenPage) {
        aGetTopNavigationTabs[i].classList = "active";
        break;
      }
    }
  }
}

/* ---------------- 29-4-2020 Mikkel Slut*/
/*----------------- 04-4-2020 Søren Start */
async function updateProgressTable(courseID, topic) {
  console.log(courseID, topic);
  let connection = await fetch(
    `APIs/API-update-statustable.php?courseID=${courseID}&topic=${topic}`
  );
  let sData = await connection.text();
  console.log(sData);
}
/*----------------- 04-4-2020 Søren Slut */
function validate() {
  let oForm = event.target;
  console.log(oForm);
  let check = 0;
  if (oForm.tagName == "INPUT") {
    var sValidateType = oForm.getAttribute("data-validate");
    console.log(sValidateType);
    oForm.classList = "";
    switch (sValidateType) {
      case "string":
        var sData = oForm.value;
        var iMin = oForm.getAttribute("data-min");
        var iMax = oForm.getAttribute("data-max");
        console.log("Validate: String");
        if (sData.length < iMin || sData.length > iMax) {
          oForm.classList.add("invalid");
          check++;
        }
        if (oForm.value == "") {
          oForm.classList.remove("invalid");
        }
        break;
      case "email":
        var sData = oForm.value;
        var regEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        console.log("Validate: String");
        if (!regEmail.test(sData)) {
          oForm.classList.add("invalid");
          check++;
        }
        if (oForm.value == "") {
          oForm.classList.remove("invalid");
        }
        break;
    }
  }
  let aValidateElements = oForm.querySelectorAll("[data-validate]");

  for (let i = 0; i < aValidateElements.length; i++) {
    aValidateElements[i].classList = "";

    let sValidateType = aValidateElements[i].getAttribute("data-validate");
    console.log(sValidateType);
    switch (sValidateType) {
      case "string":
        var sData = aValidateElements[i].value;
        var iMin = aValidateElements[i].getAttribute("data-min");
        var iMax = aValidateElements[i].getAttribute("data-max");
        console.log("Validate: String");
        if (sData.length < iMin || sData.length > iMax) {
          aValidateElements[i].classList.add("invalid");
          check++;
        }
        break;
      case "integer":
        console.log("Validate: Integer");
        var sData = parseInt(aValidateElements[i].value);
        if (/^\d+$/.test(sData) !== true) {
          console.log("FALSE");
          aValidateElements[i].classList.add("invalid");
          break;
        }
        var iMin = parseInt(aValidateElements[i].getAttribute("data-min"));
        var iMax = parseInt(aValidateElements[i].getAttribute("data-max"));
        if (sData < iMin || sData > iMax) {
          aValidateElements[i].classList.add("invalid");
          check++;
        }
        break;
      case "email":
        var sData = aValidateElements[i].value;
        var regEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        console.log("Validate: String");
        if (!regEmail.test(sData)) {
          aValidateElements[i].classList.add("invalid");
          check++;
        }
        break;
    }
  }
  if (check != 0) {
    return false;
  } else {
    return true;
  }
}

// 23-05-2020 - Mikkel Start

function showModal(e) {
  console.log(e.parentElement.dataset.id);
  showModalWindow = !showModalWindow;
  if (!showModalWindow) {
    document.querySelector(".modalBackground").style.display = "none";
    return;
  }
  document.querySelector(".modalBackground").style.display = "flex";
  document.querySelector(".modalWindow").dataset.id =
    e.parentElement.dataset.id;
}

function switchActiveEditTab(e) {
  //Save current text inside editor
  saveTopicText();

  //Get all navigation children elements
  let aNavigationElements = e.parentNode.children;

  //Iterate through array of elements and remove the class active_tab if present
  for (let i = 0; i < aNavigationElements.length; i++) {
    aNavigationElements[i].classList.remove("active_tab");
  }
  //add the class active_tab on the clicked element
  e.classList.add("active_tab");

  setEditorHTML(e);
}

function setEditorHTML(e) {
  if (e.dataset.activetab === "quiz") {
    document.querySelector("#froala-editor").style.display = "none";
    document.querySelector("#topicName").style.display = "none";
    document.querySelector("#shortDescription").style.display = "none";
    document.querySelector("#quiz").style.display = "grid";
    let aQuizElementChildren = document.querySelector("#quiz").children;
    for (let i = 0; i < aQuizElementChildren.length; i++) {
      if (aQuizElementChildren[i].localName === "input") {
        aQuizElementChildren[i].value =
          oTopicData.quiz[aQuizElementChildren[i].dataset.quiz];
        console.log(oTopicData.quiz[aQuizElementChildren[i].dataset.quiz]);
      }
    }
  } else if (e.dataset.activetab === "topicName") {
    document.querySelector("#froala-editor").style.display = "none";
    document.querySelector("#topicName").style.display = "grid";
    document.querySelector("#shortDescription").style.display = "none";
    document.querySelector("#quiz").style.display = "none";
  } else if (e.dataset.activetab === "shortDescription") {
    document.querySelector("#froala-editor").style.display = "none";
    document.querySelector("#topicName").style.display = "none";
    document.querySelector("#shortDescription").style.display = "grid";
    document.querySelector("#quiz").style.display = "none";
    document.querySelector("#shortDescription input").value =
      oTopicData.shortDescription;
  } else {
    document.querySelector("#froala-editor").style.display = "block";
    document.querySelector("#quiz").style.display = "none";
    document.querySelector("#topicName").style.display = "none";
    document.querySelector("#shortDescription").style.display = "none";
    editor.html.set(oTopicData[e.dataset.activetab]);
  }
}

function saveTopicText() {
  let currentTab = document.querySelector(".active_tab").dataset.activetab;
  let txt = editor.html.get();
  let aObjectProperties = Object.keys(oTopicData);

  if (currentTab === "quiz") {
    saveQuizData();
  } else if (currentTab === "shortDescription") {
    oTopicData[currentTab] = document.querySelector(
      "#shortDescription input"
    ).value;
  } else {
    for (let i = 0; i < aObjectProperties.length; i++) {
      if (currentTab === aObjectProperties[i]) {
        oTopicData[currentTab] = txt;
      }
    }
  }
  console.log(oTopicData);
}

function saveQuizData() {
  console.log("saveQuizData kørt");
  let aQuizElementChildren = document.querySelector("#quiz").children;

  for (let i = 0; i < aQuizElementChildren.length; i++) {
    if (aQuizElementChildren[i].localName === "input") {
      oTopicData.quiz[aQuizElementChildren[i].dataset.quiz] =
        aQuizElementChildren[i].value;
    }
  }
  console.log(oTopicData);
}

function updateImageData() {
  
  let sIntroduction = oTopicData.introduction;
  let sExample = oTopicData.example;
  let sSummery = oTopicData.summery;
 
 //Change image URL, change tmp folder to images
  let sUpdatedIntroduction = sIntroduction.replace(/\.\/tmp/g, "images");
  let sUpdatedExample = sExample.replace(/\.\/tmp/g, "images");
  let sUpdatedSummery = sSummery.replace(/\.\/tmp/g, "images");

  //Change all "" in text to &quot; so database will accept image path
  sUpdatedIntroduction = sUpdatedIntroduction.replace(/\"/g, "");
  sUpdatedExample = sUpdatedExample.replace(/\"/g, "");
  sUpdatedSummery = sUpdatedSummery.replace(/\"/g, "");

  //Update oTopicData with new string
  oTopicData.introduction = sUpdatedIntroduction;
  oTopicData.example = sUpdatedExample;
  oTopicData.summery = sUpdatedSummery;

  //Match all uploaded images in tmp folder with those actually in saved oTopicData

}

function findSavedImages(){
  //
  let sIntroduction = oTopicData.introduction;
  let sExample = oTopicData.example;
  let sSummery = oTopicData.summery;

  let sConcatenatedString = sIntroduction.concat(sExample, sSummery);

  //Find all images in HTML string
  let aSubstrings = sConcatenatedString.split('<img src=');

  console.log(aSubstrings);

  //All saved images
  let aSavedImages = [];

  //Loop through the array of substrings
  for (let i = 0; i < aSubstrings.length; i++) {
    //If a substring starts with "uploads/" then it's an image
    if (aSubstrings[i].startsWith("images/")) {
      console.log("is img");
      //Clean up the substring, so it only consists of the image file name and extension.
      //Then push the image to an array
      aSavedImages.push(aSubstrings[i].slice(7, 51));
    }
  }

  console.log(aSavedImages);



  let aImagesToBeMoved = [];

  moveImagesWithAPI(aSavedImages);

}

async function moveImagesWithAPI(images) {
  let data = new FormData();
  
  data.append("images", JSON.stringify(images));
  
  let connection = await fetch("APIs/API-move-images.php", {
    method: "POST",
    body: data,
  });

  console.log(connection.text());
}

function saveNewTopic() {
  saveTopicText();
  updateImageData();
  findSavedImages();
  
  fetchCreateTopicApi();

  // window.location.replace("edit_course.php");
}

async function fetchCreateTopicApi() {
  console.log("Denne er i funktionen fetchCreateTopicApi", oTopicData);

  let data = new FormData();
  let sTopicName = document.querySelector("#topicName input").value;
  data.append("topicContent", JSON.stringify(oTopicData));
  data.append("topicName", sTopicName);

  console.log(JSON.stringify(oTopicData));
  let connection = await fetch("APIs/API-create-topic.php", {
    method: "POST",
    body: data,
  });

  console.log(connection.text());
}

async function updateTopic(topicId) {
  saveTopicText();
  let data = new FormData();
  console.log(data);
  console.log(oTopicData);
  let sTopicName = document.querySelector("#topicName input").value;
  data.append("topicContent", JSON.stringify(oTopicData));
  data.append("topicName", sTopicName);

  //the api needs to update an existing topic
  let connection = await fetch("APIs/API-update-topic.php?topicID=" + topicId, {
    method: "POST",
    body: data,
  });

  let response = await connection.text();

  console.log(response);

  window.location.replace("edit_course.php");
}

async function fetchTopicContent(id) {
  console.log("COURSE" + id);

  const jTopic = await fetch("APIs/API-fetch-topic.php?topicID=" + id);

  let oTopic = await jTopic.json();
  console.log(oTopic);

  setTopicObjectProperties(oTopic);
}

function setTopicObjectProperties(oTopic) {
  console.log("setTopicObjectProperties");

  let oTopicContent = oTopic.topicContent;
  let sTopicName = oTopic.topicName;

  let aObjectKeys = Object.keys(oTopicContent);

  console.log(aObjectKeys);

  for (let i = 0; i < aObjectKeys.length; i++) {
    oTopicData[aObjectKeys[i]] = oTopic.topicContent[aObjectKeys[i]];
  }

  setTopicTitle(sTopicName);
}

function setTopicTitle(sTopicName) {
  //This will simply fill out the topic title with the parameter given.
  document.querySelector("#topicName input").value = sTopicName;
  document.querySelector("#edit h1").textContent = `Edit topic - ${sTopicName}`;
}

async function deleteTopic(e) {
  console.log("deleteTopic");
  let id = e.parentElement.parentElement.dataset.id;
  console.log(id);

  const jTopic = await fetch("APIs/API-delete-topic.php?topicID=" + id);

  let oTopic = await jTopic.text();

  console.log(oTopic);
  reloadPage();
}

function reloadPage() {
  window.location.reload();
}

//28-05-2020 - Mikkel Slut
