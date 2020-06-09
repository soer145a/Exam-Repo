<?php
session_start();
$_SESSION['uUsernameError'] = "";
$_SESSION['uEmailError'] = "";
if (isset($_POST['uUsername']) && isset($_POST['uPassword'])) {
    include_once('DB_Connect/connection.php');
    $uFirstName = $_POST['uFirstName'];
    $uLastName = $_POST['uLastName'];
    $uEmail = $_POST['uEmail'];
    $uUsername = $_POST['uUsername'];
    $uPassword = $_POST['uPassword'];
    $sql = "CALL insertNewCustomer(\"$uFirstName\",\"$uLastName\",\"$uEmail\",\"$uUsername\",\"$uPassword\")";
    $result = $conn->query($sql);
    if($result == TRUE){
        $inputArray = [];
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc() ) {
            array_push($inputArray, $row['errorOutput']);
        }
      } else {
              echo "0 results";
      }
      $iMessage = $inputArray[0];
    $aStatusCode = explode(":",$iMessage);
    if($aStatusCode[0] == 1){
        $_SESSION['uEmailError'] = "<p style='color:red'>ERROR - Email Already in use</p>"; 
    }
    if($aStatusCode[1]==2){
        $_SESSION['uUsernameError'] = "<p style='color:red'>ERROR - Username already in use</p>";
    }
    if($aStatusCode[2]==3){
        /* IN CASE WE NEED A SUCESS TRIGGER */
    }
    if($aStatusCode[0]==0 && $aStatusCode[1]==0){
        $_SESSION['loginStatus'] = true;
        $_SESSION['firstName'] = $_POST['uFirstName'];
        $_SESSION['lastName'] = $_POST['uLastName'];
        $_SESSION['userID'] = $inputArray[1]; 
        header('Location: index.php');
        $conn->close();
        exit();
    }}
    
    
}

?>
<?php
include_once('components/compTop.php');
?>
<span id="background">
    <img src="assets/Polygon 1.svg" alt="" />
    <img src="assets/Polygon 2.svg" alt="" />
</span>

<main>

    <!-- 04/05/20 - 12.50 - Daniel har lavet små ændringer til formen.  -->
    <div id="signUpArea">
        <form action="signup.php" method="post" id="frmSignUp" onsubmit=" return validate()">
            <h1>Sign up here</h1>
            <label for="">
                <p>Username (Between 2 and 50 characters)</p>
                <input autofocus type="text" name="uUsername" placeholder="Type in a username" data-validate="string" data-min="2" data-max="50" oninput="validate()">
                <?=$_SESSION['uUsernameError']?>
            </label>
            <label for="">
                <p>Password (Between 2 and 50 characters)</p>
                <input type="password" name="uPassword" placeholder="Type in a password" data-validate="string" data-min="2" data-max="50" oninput="validate()">
            </label>
            <label>
                <p>First name (Between 2 and 30 characters)</p>
                <input type="text" name="uFirstName" placeholder="Type in your first name" data-validate="string" data-min="2" data-max="30" oninput="validate()">
            </label>
            <label>
                <p>Last name (Between 2 and 30 characters)</p>
                <input type="text" name="uLastName" placeholder="Type in your last name" data-validate="string" data-min="2" data-max="30" oninput="validate()">
            </label>
            <label>
                <p>Email address (Must be Valid)</p>
                <input type="text" name="uEmail" placeholder="Type in your E-mail" data-validate="email" oninput="validate()">
                <?=$_SESSION['uEmailError']?>
            </label>
            <button type="submit">SIGN UP</button>
        </form>
    </div>


</main>
<?php
include_once('components/compBottom.php');
?>