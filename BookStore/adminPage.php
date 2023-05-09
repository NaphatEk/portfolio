<?php

    session_start();

    if(!$_SESSION['userid']){
        header("location: index.php");
    }
     else {
        
?>

<?php
	include ('server.php');

    if(isset($_POST['add_to_Book'])){

        $sql = "SELECT * FROM book WHERE BookID = '".$_POST['add']."'";
        $result = $conn->query($sql);
    
        while($row = $result->fetch_assoc()){
            $bookID = $row['BookID'];
            $quantity = $_POST['quantity'];
        }
    
        $sql = "UPDATE book SET quantity = quantity + $quantity WHERE BookID = '$bookID'";
        $conn->query($sql);
    }
?>	

<?php
	include ('server.php');

    if(isset($_POST['delete_book'])){
        $sql = "DELETE FROM book WHERE BookID = '".$_POST['delete']."'";
        $conn->query($sql);
    }

?>


<html>
<body>
<head>
<link rel="stylesheet" type="text/css" href="Astyle.css">
</head>


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
    echo '<a class="logo">Web BookStore</a>';
    echo '<div class="hf">';
    echo '<form action="insertBook.php"><input class="logout-button" type="submit" name="newBook" value="Insert book"></form>';
    echo '<form action="logout.php"><input class="logout-button" type="submit" name="submitButton" value="Logout"></form>';
    echo '</div>';
    echo '</header>';
   
    include ('server.php');
    $sql = "SELECT * FROM book";
    $result = $conn->query($sql);


    echo "<table>
    <thead>
    <tr>
    <th style='width: 5%;'>BookID</th>
    <th style='width: 35%;'>BookTitle</th>
    <th style='width: 20%;'>TYPE</th>
    <th style='width: 5%;'>Quantity</th>
    <th style='width: 35%;'>Action</th>
    </tr>
    </thead>
    <tbody>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='text-align: center;'>" . $row["BookID"] . "</td>";
        echo "<td style='text-align: center;'>" . $row["BookTitle"] . "</td>";
        echo "<td style='text-align: center;'>" . $row["Type"] . "</td>";
        echo "<td style='text-align: center;'>" . $row["Quantity"] . "</td>";
        echo "<td style='text-align: center;'>
                <form style='display: inline-block; margin-right: 10px;' action='' method='post'>
                    <input type='number' value='0' name='quantity' min='0' step='1' style='width: 50px;'>
                    <input type='hidden' value='".$row['BookID']."' name='add'/>
                    <input class='add-to-book action-button' type='submit' name='add_to_Book' value='Add to Book'/>
                </form>
                <form style='display: inline-block;' action='' method='post'>
                    <input type='hidden' value='".$row['BookID']."' name='delete'/>
                    <input class='delete-button action-button' type='submit' name='delete_book' value='delete'>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</tbody>
    </table>";
    

     }
?>
</body>
</html>