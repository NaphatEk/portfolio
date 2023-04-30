<?php

    session_start();

    if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] == 'admin'){
        header("location: adminPage.php");
    }
    else {
 ?>

<html>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
<header>
<blockquote>
    <a href="index.php"><img src="image/logo.png"></a>
</blockquote>
</header>
<blockquote>
    <?php
    
   
    if(isset($_POST['loginButton'])) {
        include ('server.php');
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['pwd']);
        $passwordenc = md5($password);

        $userCheck = "SELECT * FROM customer WHERE UserName = '$username' AND Password = '$passwordenc'";
        $result = mysqli_query($conn, $userCheck);
    
        if (mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_array($result);

            $_SESSION['userid'] = $row['id'];
            $_SESSION['user'] = $row['firstname']. " " . $row['lastname'];
            $_SESSION['userLevel'] = $row['userLevel'];

            if($_SESSION['userLevel'] == 'admin'){
                header("Location: adminPage.php");
            }
            if($_SESSION['userLevel'] == 'member'){
            header("Location: index.php");
        }
        else {
            echo 'Wrong username/password try again';
        }
    }
    else{
        header("Location: index.php");  
    }
}
   
}
?>

<center><h1>Login</h1></center>
<form method="post" action="login.php">
    Username:<br><input type="text" name="username" required placeholder="Enter your user name" maxlength="20"/>
    <br><br>
    Password:<br><input type="password" name="pwd" required placeholder="Enter your password" maxlength="20"/>
    <br><br>
    <input class="button" type="submit" name="loginButton" value="Login"/>
    <input class="button" type="button" name="cancel" value="Cancel" onClick="window.location='index.php';" />
</form>
<a href = 'register.php'>Go to register</a>
</blockquote>
</body>
</html>