<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Insert book page</title>
</head>
<body>
    <header>
        <blockquote>
            <a href="adminPage.php"><img src="image/logo.png"></a>
        </blockquote>
    </header>
    <blockquote>
        <?php
        include ('server.php');

        if(isset($_POST['submitButton'])) {
            $bookID = $_POST['bookID'];
            $bookTitle = $_POST['bookTitle'];
            $price = $_POST['price'];
            $author = $_POST['author'];
            $type = $_POST['type'];
            $quantity = $_POST['quantity'];

            $bookCheck = "SELECT * FROM book WHERE bookid = '$bookID'";
            $query = mysqli_query($conn, $bookCheck);
            $checkResult = mysqli_fetch_assoc($query);
            if ($checkResult) {
                echo "Username already exists!";
            }
            else {

                $query = "INSERT INTO Book(BookID, BookTitle, Price, Author, Type, Quantity) 
                VALUES ('$bookID', '$bookTitle', '$price', '$author', '$type', '$quantity')";
                if(mysqli_query($conn, $query)) {
                    header("Location: adminPage.php");
                } else {
                    $_SESSION['error'] = 'Something went wrong';
                    header("Location: insertBook.php");
                }
                
            }
            mysqli_close($conn);
        }
   
    ?>
    <?php
  echo "
  <h2>Insert book</h2>
  <form method='post'>
      <label for='bookID'>Book id:</label>
      <input type='text' id='bookID' name='bookID' required placeholder='Enter book ID' maxlength='50'>
      <label for='bookTitle'>Book title:</label><br>
      <input type='text' id='bookTitle' name='bookTitle' required placeholder='Enter book title' maxlength='50'><br>
      <label for='price'>Price:</label><br>
      <input type='text' id='price' name='price' required placeholder='Enter price' maxlength='50'><br>
      <label for='author'>Author:</label><br>
      <input type='text' id='author' name='author' required placeholder='Enter author' maxlength='20'><br>
      <label for='type'>Type:</label><br>
      <input type='text' id='type' name='type' required placeholder='Enter type' maxlength='20'><br><br>
      <label for='quantity'>Quantity:</label><br>
      <input type='text' id='quantity' name='quantity' required placeholder='Enter quantity' maxlength='20'><br>
      
      <input class='button' type='submit' name='submitButton' value='Submit'> 
      <input class='button' type='button' name='cancel' value='Cancel' onClick=\"window.location.href='adminPage.php'\" />
  </form>
";


?>
</body>
</html>