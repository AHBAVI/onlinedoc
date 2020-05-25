<?php
session_start();
if (isset($_SESSION['una'])) {
	$una = $_SESSION['una'];
	echo $una;
}else{
	header("location:../login/");
}
if (isset($_POST['delp'])) {
	$file = "../pic/".$_POST['link'];

	if (!unlink($file)) {
	  echo ("Error deleting $file");
	} else {
	  echo ("Deleted $file");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 180px;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}
</style>
</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>


<?php

$dir = "../pic/";

// Sort in ascending order - this is default
$a = scandir($dir);

// Sort in descending order
$b = scandir($dir,1);
$count = sizeof($b)-2;
for ($i=0; $i < $count; $i++) { 
	echo '
		<div class="gallery">
		  <a target="_blank" href="img_5terre.jpg">
		    <img src="../pic/'.$b[$i].'" alt="Cinque Terre" width="600" height="400">
		  </a>
		  <form method="post">
		  <input type="text" value="'.$b[$i].'" name="link">
		  <input type="submit" name="delp" value="delete">
		  </form>
		</div>
	';
}

?>
</body>
</html>
