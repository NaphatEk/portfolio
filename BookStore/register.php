<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Register</title>
</head>
<body>
    <header>
        <blockquote>
            <a href="index.php"><img src="image/logo.png"></a>
        </blockquote>
    </header>
    <blockquote>
        <?php
        include ('server.php');

        if(isset($_POST['submitButton'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $phone = $_POST['phone'];
            $username = $_POST['username'];
            $password = $_POST['password'];
        
           
            $userCheck = "SELECT * FROM customer WHERE username = '$username'";
            $query = mysqli_query($conn, $userCheck);
            $checkResult = mysqli_fetch_assoc($query);
            if ($checkResult) {
                echo "Username already exists!";
            } else {
                $passwordenc = md5($password);
               
                $query = "INSERT INTO Customer (CustomerFName, CustomerLName, CustomerPhone, UserName, Password, userLevel) 
                VALUES ('$fname', '$lname', '$phone', '$username', '$passwordenc', 'member')";
                if(mysqli_query($conn, $query)) {
                    $_SESSION['success'] = 'Insert user successfully';
                    header("Location: index.php");
                } else {
                    $_SESSION['error'] = 'Something went wrong';
                    header("Location: register.php");
                }
            }
            mysqli_close($conn);
        }
    ?>
    <h2>Register</h2>
    <form method="post">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required placeholder="Enter your first name" maxlength="50"><br>
        <label for="lname">Last Name:</label><br>
        <input type="text" id="lname" name="lname" required placeholder="Enter your last name" maxlength="50"><br>
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" required placeholder="Enter your phone number" maxlength="50"><br>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required placeholder="Enter your user name" maxlength="20"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required placeholder="Enter your password" maxlength="20"><br><br>
        <input class="button" type="submit" name="submitButton" value="Submit"> 
        <input class="button" type="button" name="cancel" value="Cancel" onClick="window.location='index.php';" />
    </form>
</blockquote>
</body>
</html>


