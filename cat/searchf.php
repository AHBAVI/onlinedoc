<?php
include('../con.php');
if (isset($_REQUEST['stl'])) 
{
	$stl = $_REQUEST['stl'];
	$cs = $_REQUEST['cs'];
	session_start();
	$cat = $_SESSION['cat'];


		if (strlen($stl)>=2) 
		{
		//echo 'serch_text-'.$stl;
		if ($cs == "all") {
			$sql = "SELECT * FROM fomu WHERE status=1 AND (title LIKE '%$stl%' OR des LIKE '%$stl%')";
		}else{
			$sql = "SELECT * FROM fomu WHERE status=1 AND cat='$cs' AND (title LIKE '%$stl%' OR des LIKE '%$stl%')";
		}
		
		$result = $con->query($sql);
		if ($result->num_rows>0) 
		{
		
			while ($row = $result->fetch_assoc()) 
			{
				$title = $row['title'];
				echo '
				<option class="live" value="'.$title.'" onclick="slivef(this.value)" style="padding: 5px;max-height: 50px;white-space: normal;">
					<p style="white-space: normal;">'.$title.'</p><br>
				</option>
				';
			}

		}
		else
		{
			echo '<option class="live" style="padding: 10px;">
				No Suggested:(
				</option>';
		}
	}
}
elseif (isset($_REQUEST['sr'])) {
	$sr = $_REQUEST['sr'];
	$cs = $_REQUEST['csr'];
	//echo $cs;

	if ($cs == "all") {
		$sql = "SELECT * FROM fomu WHERE status = 1 AND (title LIKE '%$sr%' OR des LIKE '%$sr%') ORDER BY fid DESC";
	}else{
		$sql = "SELECT * FROM fomu WHERE status = 1 AND cat = '$cs' AND (title LIKE '%$sr%' OR des LIKE '%$sr%') ORDER BY fid DESC";
	}
	
	$result = $con->query($sql);
	if ($sr != "") {
		if ($result ->num_rows > 0) {
			$count = 0;
			while ($row = $result->fetch_assoc()) {

				$ste = utf8_encode($sr);
				$fomue = utf8_encode($row['des']);

		          $sqlc = "SELECT * FROM fusec WHERE fid='".$row['fid']."'";
		          $resultc = $con->query($sqlc);
		          if ($rowc = $resultc->fetch_assoc()) {
		            $count = $rowc['clicks'];
		          }

				//find the word position
				$sqlc = "SELECT POSITION('$ste' IN '$fomue') AS sindex;";
				$resultc = $con->query($sqlc);
				if ($rowc = $resultc->fetch_assoc()) {
					$sindex = $rowc['sindex']-1;
				}
				if ($sindex <= 0) {
					$sindex = 0;
					$eindex = 202;
					$len = 0;
					$sindex2 = 0;
				}else{
					$sindex = $sindex;
					$eindex = 202;
					$len = strlen($sr);
					$sindex2 = $sindex+strlen($sr);
				}
				$cal = substr($row['des'], $sindex, $len).substr($row['des'],$sindex2, $eindex);
				if (strlen($cal) < 202) {
					$cal = "...".substr($row['des'],0, 202 - (strlen($cal)-3));
				}else{
					$cal = "";
				}


				echo '
					<a href="see/index.php?see='.$row['fid'].'">
				        <div class="leftcolumn">
				          <div class="card">
			                <h2><i class="fa fa-eye" aria-hidden="true" style="float:right;font-size:18px">'.$count.'</i></h2>

			                
			                <div class="fakeimg"><h2 style="text-align:center;margin: auto;">'.$row['title'].'</h2></div>
				            <p><b>'.substr($row['des'], $sindex, $len).'</b>'.substr($row['des'],$sindex2, $eindex).''.$cal.'</p>
				          </div>
				        </div>
			        </a>';
			}
		}else{
			echo '<h1 style="text-align:center">No Suggested <br>:(</h1>';
		}
		
	}elseif ($sr == "") {
		if ($cs == "all") {
			$sql = "SELECT * FROM fomu WHERE status = 1 ORDER BY fid DESC";
		}else{
			$sql = "SELECT * FROM fomu WHERE status = 1 AND cat = '$cs' ORDER BY fid DESC";
		}
		$count = 0;
		$result = $con->query($sql);
		if ($result ->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {

	          $sqlc = "SELECT * FROM fusec WHERE fid='".$row['fid']."'";
	          $resultc = $con->query($sqlc);
	          if ($rowc = $resultc->fetch_assoc()) {
	            $count = $rowc['clicks'];
	          }

				echo '
					<a href="see/index.php?see='.$row['fid'].'">
				        <div class="leftcolumn">
				          <div class="card">
			                <h2><i class="fa fa-eye" aria-hidden="true" style="float:right;font-size:18px">'.$count.'</i></h2>

			                
			                <div class="fakeimg"><h2 style="text-align:center;margin: auto;">'.$row['title'].'</h2></div>
				            <p>'.substr($row['des'], 0, 202).'</p>
				          </div>
				        </div>
			        </a>';
			}
		}else{
			echo '<h1 style="text-align:center">No Suggested <br>:(</h1>';
		}
	}


}
$con->close();
?>