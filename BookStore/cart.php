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

session_start();
include ('server.php');

if(isset($_POST['delc']) or isset($_POST['cancel'])){
    
    $sql = "DELETE FROM cart";
    $conn->query($sql);
}

if(isset($_POST['checkout'])){
    $sql = "SELECT * FROM book,cart WHERE book.BookID = cart.BookID";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){
        $bookID = $row['BookID'];
        $quantity = $row['Quantity'];

        if(!isset($_SESSION['userid'])){
            $_SESSION['check'] = 'You must login first';
            header("Location: login.php");
        }
        else{
            $setBook = "UPDATE Book SET Quantity = Quantity - $quantity WHERE BookID = '$bookID'";
            $conn->query($setBook);

            if(mysqli_query($conn, $sql)) {
                $_SESSION['success'] = 'Your puchase successfully';
                $sql = "DELETE FROM cart";
                $conn->query($sql);
                header("Location: index.php");
            } else {
                $_SESSION['error'] = 'Something went wrong';
                header("Location: cart.php");
            }
        }
    }
}

if(isset($_POST['cancel'])){
    header("Location: index.php");
}

$sql = "SELECT book.BookTitle, book.Image, cart.Price, cart.Quantity, cart.TotalPrice FROM book,cart WHERE book.BookID = cart.BookID;";
	$result = $conn->query($sql);

echo '<table style="width:50%; margin:auto;">';
echo '<tr><th class="cart-header"><i class="fa fa-shopping-cart"></i> <span class="cart-title">Cart</span> 
      <form class="empty-cart-form" action="" method="post">
        <input type="hidden" name="delc"/>
        <input class="cbtn empty-cart-btn" type="submit" value="Empty Cart">
      </form>
      </th></tr>';

    $total = 0;
    while($row = $result->fetch_assoc()){
    	echo "<tr><td>";
    	echo '<img src="'.$row["Image"].'"width="20%"><br>';
    	echo $row['BookTitle']."<br>RM".$row['Price']."<br>";
    	echo "Quantity: ".$row['Quantity']."<br>";
    	echo "Total Price: RM".$row['TotalPrice']."</td></tr>";
    	$total += $row['TotalPrice'];
    }
    echo "<tr><td style='text-align: right;background-color: #f2f2f2;'>";
    echo "Total: <b>RM".$total."</b></td></tr>";
    echo '<tr><td><center><form action="#" method="post"><input class="button" type="submit"name="checkout" value="CHECKOUT"/>';
    echo '<input class="button" type="submit" name="cancel" value="Cancel" /></form></center></td></tr>';
    echo "</table>";
    echo '</blockquote>';

    ?>
    </body>
</html>