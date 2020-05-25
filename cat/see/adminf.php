<?php
session_start();
if (isset($_SESSION['una'])) {
	include("../../con.php");
	$una = $_SESSION['una'];
	echo $una;
}else{
	header("location:login/");
}
if (isset($_POST['lo'])) {
	session_start();
	session_destroy();
	header("location:login/");
}
$post = '

	<form method="POST" action="adminf.php">
		CAT:<input type="text" name="cat"><br>
		TITLE:<input type="text" name="title"><br>
		Fomu:<textarea type="text" name="fm" value="" rows="4" cols="40"></textarea><br>
		DES:<textarea type="text" name="des" id="des" rows="15" cols="80"></textarea><br>
		<input type="button" name="up" value="Link_ph" onclick="lp(this.value)"><input type="button" value="example" onclick="ex(this.value)"><br>
		Mention:<input type="text" name="mens" id="search" oninput="searchlive(this.value)"><br>

            <div id="livesearch" style="border: 0px;background: #fff;margin-top: 0px;border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);display: block;max-width:200px;">
            </div>

		<textarea type="text" name="men" id="men" rows="7" cols="40"></textarea><br>

		<input type="submit" name="submit" value="upload">		
	</form>

';

if (isset($_POST['submit'])) {
	$cat = $_POST['cat'];
	$des = $_POST['des'];
	$fm = $_POST['fm'];
	$title = $_POST['title'];
	$men = $_POST['men'];

	$sql = "SELECT MAX(fid) AS fid FROM fomu;";
	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()) {
		$bid = substr($row['fid'], 1)+1;
		$bid = "f".$bid;

	}
	$sql = "INSERT INTO fomu VALUES('$bid','$title','$fm','$des','$cat','1')";
	if ($con->query($sql) == TRUE) {
		echo "pass";
	}else{
		echo "fail".$con->error;
	}

	$sql1 = "SELECT * FROM mention WHERE id='$bid'";
	$result = $con->query($sql1);
	if ($result->num_rows>0) {
		if ($men == "") {
			$sql = "DELETE FROM mention WHERE id='$bid'";
			$con->query($sql);
		}else{
			$sql = "UPDATE mention SET mention='$men' WHERE id='$bid'";
			if ($con->query($sql) == TRUE) {
				echo "pass";
			}else{
				echo "fail";
			}	
		}

	}elseif($men != ""){
		$sql = "INSERT INTO mention(id,mention) VALUES('$bid','$men')";
		if ($con->query($sql) == TRUE) {
			echo "pass";
		}else{
			echo "fail";
		}
	}

}

elseif (isset($_GET['edit'])) {
	$ar = "";
	$id = $_GET['edit'];
	$sql = "SELECT * FROM fomu WHERE fid='$id'";
	$result = $con->query($sql);
	while ($row = $result->fetch_assoc()) {

		$ms = "SELECT * FROM mention WHERE id='".$row['fid']."'";
		$mr = $con->query($ms);
		if ($rm = $mr->fetch_assoc()) {
			$mn = $rm['mention'];

			$mna = explode(",", $mn);
			
			foreach ($mna as $mng) {
				$sql1 = "SELECT * FROM post WHERE pid='$mng'";
				$sql2 = "SELECT * FROM fomu WHERE fid='$mng'";

				$result1 = $con->query($sql1);
				$result2 = $con->query($sql2);
				if ($rr = $result1->fetch_assoc()) {
					$ar = $ar.",".$rr['title'];
				}elseif ($rr = $result2->fetch_assoc()) {
					$ar = $ar.",".$rr['title'];
				}
				if (substr($ar, 0,1) == ",") {
					$ar = ltrim($ar,",");
				}	

			}

		}else{
			$mn ="";
		}

		$post = '	
			<form method="POST" action="adminf.php">
				CAT:<input type="text" name="cat" value="'.$row['cat'].'"><br>
				TITLE:<input type="text" name="title" value="'.$row['title'].'"><br>
				Fomu:<textarea type="text" name="fm" value="" rows="4" cols="40">'.$row['fomular'].'</textarea><br>
				DES:<textarea type="text" name="des" id="des" value="" rows="15" cols="80">'.$row['des'].'</textarea><br>
				<input type="button" name="up" value="Link_ph" onclick="lp(this.value)"><input type="button" value="example" onclick="ex(this.value)"><br>
				Mention:<input type="text" name="mens" id="search" oninput="searchlive(this.value)"><br>

		            <div id="livesearch" style="border: 0px;background: #fff;margin-top: 0px;border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);display: block;max-width:200px;">
		            </div>

				<textarea type="text" name="men" id="men" rows="7" cols="40" value="">'.$mn.'</textarea><br>
				<p>'.$ar.'</p>
				<button type="submit" name="up" value="'.$id.'">edit</button>	<button type="submit" name="up" value="'.$id.'">Link_ph</button>	
			</form>';
	}
}
elseif (isset($_POST['up'])) {
	$id = $_POST['up'];
	$cat = $_POST['cat'];
	$des = $_POST['des'];
	$fm = $_POST['fm'];
	$title = $_POST['title'];
	$men = $_POST['men'];

	$sql = "UPDATE fomu SET cat='$cat',title='$title',des='$des',fomular='$fm' WHERE fid='$id'";
	if ($con->query($sql) == TRUE) {
		echo "pass";
	}else{
		echo "fail";
	}

	//mention
	$sql1 = "SELECT * FROM mention WHERE id='$id'";
	$result = $con->query($sql1);
	if ($result->num_rows>0) {
		if ($men == "") {
			$sql = "DELETE FROM mention WHERE id='$id'";
			$con->query($sql);
		}else{
			$sql = "UPDATE mention SET mention='$men' WHERE id='$id'";
			if ($con->query($sql) == TRUE) {
				echo "pass";
			}else{
				echo "fail";
			}	
		}

	}elseif($men != ""){
		$sql = "INSERT INTO mention(id,mention) VALUES('$id','$men')";
		if ($con->query($sql) == TRUE) {
			echo "pass";
		}else{
			echo "fail";
		}
	}

}
if (isset($_GET['del'])) {
	$did = $_GET['del'];
	$sql = "DELETE FROM fusec WHERE fid='$did'";
	
	$con->query($sql);
	$con->query($sql);

	$sql = "DELETE FROM fomu WHERE fid='$did'";
	
	$con->query($sql);
	$con->query($sql);

}
/*$str = "Hello world. It's a beautiful day.";
$str = explode(" ",$str);
print_r($str);
foreach ($str as $value) {
  echo "$value <br>";
}*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>INSERT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #008CBA;
  color: white;
}
</style>
</head>
<body>
	<form method="post">
		<input type="submit" name="lo" value="Logout">
	</form>
	<a href="img_up/"><button>Upload_ph</button></a>
	<a href="admin.php"><button>POST</button></a>
	
	<?php echo $post;?>
	<br>
	<div>
		<?php
		if (isset($_SESSION['una'])) {
			$sql = "SELECT * FROM fomu;";
			$result = $con->query($sql);

			echo '<table id="customers">
					<tr>
						<th>CAT</th>
						<th>Title</th>
						<th>Fomular</th>
						<th>DES</th>
						<th>MEN</th>
						<th>Action</th>
					</tr>';

			while ($row = $result->fetch_assoc()) {

				$ms = "SELECT * FROM mention WHERE id='".$row['fid']."'";
				$mr = $con->query($ms);
				if ($rm = $mr->fetch_assoc()) {
					$mn = $rm['mention'];
				}else{
					$mn ="";
				}

				echo '
					<tr>
						<td>'.$row['cat'].'</td>
						<td>'.$row['title'].'</td>
						<td>'.$row['fomular'].'</td>
						<td><p style="white-space: pre-line;">'.$row['des'].'</p></td>
						<td>'.$mn.'</td>
						<td>
							<form>
								<button type="submit" name="edit" value="'.$row['fid'].'">edit</button>
								<button type="submit" name="del" value="'.$row['fid'].'">del</button>
							</form>
						</td>
					</tr>
				';
			}
			echo "</table>";
		}
		?>
	</div>
	<script type="text/javascript" src="ad.js"></script>
</body>
</html>