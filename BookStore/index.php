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
	
<?php
	include ('server.php');

	if(isset($_POST['add'])){

		$sql = "SELECT * FROM book WHERE BookID = '".$_POST['add']."'";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()){
            
			$bookID = $row['BookID'];
			$quantity = $_POST['quantity'];
			$price = $row['Price'];
		}

		$sql = "INSERT INTO cart(BookID, Quantity, Price, TotalPrice) VALUES('".$bookID."', ".$quantity.", ".$price.", Price * Quantity)";
		$conn->query($sql);
	
	}

	$sql = "SELECT * FROM book";
	$result = $conn->query($sql);
?>	


<?php

echo '<header>';
echo '<div style="width: 10%;"></div>'; 
echo '<style>
a.logo {
  color: white;
  font-size: 32px;
  text-decoration: none;
}
</style>';
echo '<a class="logo" href="index.php">Web BookStore</a>';
echo '<div class="hf">';
echo '<form action="cart.php"><input class="hi" type="submit" name="submitButton" value="cart"></form>';

if(!isset($_SESSION['userid'])){
    echo '<form action="register.php"><input class="hi" type="submit" name="submitButton" value="Register"></form>';
    echo '<form action="login.php"><input class="hi" type="submit" name="submitButton" value="Login"></form>';
}
else{
    echo '<form action="logout.php"><input class="hi" type="submit" name="submitButton" value="Logout"></form>';
    echo "<img src='image/loggedIn.png' width='100' height='auto'>";
}

echo '</div>';
echo '</header>';

echo '<blockquote>';
echo "<table id='myTable' style='width:80%; margin:0 auto;'>";

$count = 0; 

while($row = $result->fetch_assoc()) {
    if ($count % 3 == 0) { 
        echo "<tr>";
    }
	$max_quantity = $row['Quantity'];
    
echo "<td>";
echo "<table>";
echo '<tr><td>'.'<div class="img-resize"><img src="'.$row["Image"].'"></div>'.
    '</td></tr><tr><td style="padding: 5px;">Title: '.$row["BookTitle"].
     '</td></tr><tr><td style="padding: 5px;">'.'</td></tr><tr><td style="padding: 5px;">Author: '.$row["Author"].
     '</td></tr><tr><td style="padding: 5px;">Type: '.$row["Type"].'</td></tr><tr><td style="padding: 5px;">';

    echo 'Bath:'.$row["Price"].'</td></tr><tr><td style="padding: 5px;">
    <form action="" method="post">
    Quantity: <input type="number" value="0" name="quantity" min="0" max="'.$max_quantity.'" step="1" style="width: 20%" /><br>
    <input type="hidden" value="'.$row['BookID'].'" name="add"/>';
	if ($row["Quantity"] > 0) {
    echo '<input class="button" type="submit" value="Add to Cart"/>
    </form></td></tr>';
} else {
    echo '<span style="color: red;">Sold Out</span></td></tr>';
}
echo "</table>";
echo "</td>";
    $count++; 
}

}
?>
</body>
</html>