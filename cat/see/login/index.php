<?php
$msg = "";
if (isset($_POST['submit'])) {
	$una = $_POST['una'];
	$wsp = md5($_POST['wsp']);
	include("../../../con.php");

	$sql = "SELECT * FROM admin WHERE una = '$una' AND wsp = '$wsp'";
	$result = $con->query($sql);

	if ($result->num_rows>0) {
		session_start();
		$_SESSION['una'] = $una;
		header("location:../admin.php");
		echo "ahb";
	}else{
		$msg = "WrOng;";
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LoGiN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<form method="post" action="">
		UnA:<input type="text" name="una"><br>
		WSP:<input type="password" name="wsp"><br>
		<input type="submit" name="submit" value="IN"><br>
		<?php echo $msg;?>
	</form>
</body>
</html>