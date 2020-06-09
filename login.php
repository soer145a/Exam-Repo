<?php
session_start();
if (isset($_POST['uUsername']) && isset($_POST['uPassword'])) {
    include_once('DB_Connect/connection.php');
    include_once('private/credentials.php');
    $username = $_POST['uUsername'];
    $password = $_POST['uPassword'];
    if($password == $secretPassword && $username == $secretUsername){
        header('Location: admin.php');
    }
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $_SESSION['loginStatus'] = true;
            $_SESSION['firstName'] = $row['firstname'];
            $_SESSION['lastName'] = $row['lastname'];
            $_SESSION['userID'] = $row['id'];
            header('Location: index.php');
            exit();
        }
    }
    $conn->close();
}
include_once('components/compTop.php');
?>
<span id="background">
    <img src="assets/Polygon 1.svg" alt="" />
    <img src="assets/Polygon 2.svg" alt="" />
</span>
<main>
    <!-- 04/05/20 - 13.30 - Daniel har lavet små ændringer til formen.  -->

    <div id="loginMainContent">
        <form id="frmLogIn" action="login.php" method="post">
            <h1>Login</h1>
            <label>
                <p>Username</p>
                <input type="text" placeholder="Type in your username" name="uUsername">
            </label>
            <label>
                <p>Password</p>
                <input placeholder="Type in your password" type="password" name="uPassword">
            </label>
            <button type="submit">LOG IN</button>
        </form>
    </div>
</main>
<?php
include_once('components/compBottom.php');
?>