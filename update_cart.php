<html>
<body>

<?php include("header.php"); ?>

<?php

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "geek_text");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


echo "<div class='container'><br><br><br><br><br>" ;
foreach ($_REQUEST as $key => $value) {
		echo "$key value $value<br>";
}
echo "</div>";
 
// Escape user inputs for security
$id = $_SESSION['username'];
$bookIDNum = mysqli_real_escape_string($link, $_REQUEST['cart_bookid']);
$quan = mysqli_real_escape_string($link, $_REQUEST['cart_quantity']);

if ($_POST['action']=='Update'){
	$sql = "UPDATE cart SET bookid= '$bookIDNum', quantity = '$quan' WHERE user_id ='$id' and bookid ='$bookIDNum'";

		if(mysqli_query($link, $sql)){
			header("location:shopping_cart.php");
		}
		else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
}

if ($_POST['action']=='Remove'){
	$sql1 = "DELETE FROM cart WHERE user_id='$id' and bookid='$bookIDNum'";

		if(mysqli_query($link, $sql1)){
			header("location:shopping_cart.php");
		}
		else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
}

if ($_POST['action']=='Save For Later'){
	$sql2 = "INSERT INTO savedcart VALUES('$id', '$bookIDNum', '$quan')";
	$sql3 = "DELETE FROM cart WHERE user_id='$id' and bookid='$bookIDNum'";

		if(mysqli_query($link, $sql2) && mysqli_query($link, $sql3)) {
			header("location:shopping_cart.php");
		}
		else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
}

 
	// close connection
	mysqli_close($link);
?>

</body>
</html>

