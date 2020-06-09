<?php
session_start();
include_once('DB_Connect/connection.php');

$uFirstName = $_SESSION['firstName'];
$uLastName = $_SESSION['lastName'];
$uID = $_SESSION['userID'];
if(isset($_POST['deleteUsername'])&&isset($_POST['deletePassword'])){
    include_once('DB_Connect/procedures.php');
    $deleteAllUserData = str_replace("::uID::",$uID, $deleteAllUserData);
    echo $deleteAllUserData;
    $sql = $deleteAllUserData;
    $result = $conn->query($sql);
    header('Location: logout.php');
    exit();
}
if(isset($_POST['uFirstName'])){
    $uEmail = $_POST['uEmail'];
    $uFirstName = $_POST['uFirstName'];
    $uLastName = $_POST['uLastName'];
    $uUsername = $_POST['uUsername'];
    $uPassword = $_POST['uPassword'];
    $uID = $_POST['uID'];
    $sql = "UPDATE users SET firstname='$uFirstName', lastname='$uLastName', email='$uEmail', username='$uUsername', password='$uPassword'  WHERE id=$uID";
    $conn->query($sql);
}
$sql = "SELECT * FROM users WHERE id=$uID";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
include_once('components/compTop.php');
?>
 <span id="background">
      <img src="assets/Polygon 1.svg" alt="" />
      <img src="assets/Polygon 2.svg" alt="" />
</span>
<main id="profile">
<div id="deleteModalWindow" onclick="closeDeleteModal()">
   
</div>
<div id="deleteModalContent">
        
        <h1>DELETE ACCOUNT</h1>
        <p>Are you sure you want to permanently delete your profile?</p>
        <p>Type your username and password below to delete</p>
        <form id="frmDeleteUser" action="profile.php" method="post">
        <label><p>Username:</p>
            <input type="text" name="deleteUsername">
        </label>
        <label><p>Password:</p>
            <input type="password" name="deletePassword">
        </label> <br>
        <button class="btn-primary" type="submit">DELETE</button>
        <button type="button" class="btn-quaternary" onclick="closeDeleteModal()">CANCEL</button>
    </form>
    </div>
<div id="profileInfo">
<h1>Profile</h1>
<div id="profileContent">
<p>First Name: <span id="pFirstName"><?= $row['firstname']?></span></p>
<p>Last Name: <span id="pLastName"><?= $row['lastname']?></p></span>
<p>Email: <span id="pEmail"><?= $row['email']?></p></span>
<p>Username: <span id="pUsername"><?= $row['username']?></p> </span>
<p>password: <span id="pPassword"><?php $iPasswordLenght = strlen($row['password']); for ($i=0; $i < $iPasswordLenght; $i++){echo '*';} ?></p>
<input id="hiddenPassword" type="hidden" value="<?=$row['password']?>">
<input id="hiddenID" type="hidden" value="<?=$row['id']?>">
<button class="btn-primary" onclick="editProfile()">EDIT</button>
<button class="btn-quaternary" onclick="openDeleteModal()">DELETE</button>
</div>
</div>
</main>
<?php
include_once('components/compBottom.php');
?>