<?php
include('../../con.php');
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
			$sql = "SELECT * FROM post WHERE status=1 AND (title LIKE '%$stl%' OR post LIKE '%$stl%')";
		}else{
			$sql = "SELECT * FROM post WHERE status=1 AND cat='$cs' AND (title LIKE '%$stl%' OR post LIKE '%$stl%')";
		}
		
		$result = $con->query($sql);
		if ($result->num_rows>0) 
		{
		
			while ($row = $result->fetch_assoc()) 
			{
				$title = $row['title'];
				echo '
				<option class="live" value="'.$title.'" onclick="slive(this.value)" style="padding: 5px;max-height: 50px;white-space: normal;">
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
		$sql = "SELECT * FROM post WHERE status = 1 AND (title LIKE '%$sr%' OR post LIKE '%$sr%') ORDER BY pid DESC";
	}else{
		$sql = "SELECT * FROM post WHERE status = 1 AND cat = '$cs' AND (title LIKE '%$sr%' OR post LIKE '%$sr%') ORDER BY pid DESC";
	}
	
	$result = $con->query($sql);
	if ($sr != "") {
		if ($result ->num_rows > 0) {

			while ($row = $result->fetch_assoc()) {

				$ste = utf8_encode($sr);
				$poste = utf8_encode($row['post']);

		          $sqlc = "SELECT * FROM usec WHERE pid='".$row['pid']."'";
		          $resultc = $con->query($sqlc);
		          if ($rowc = $resultc->fetch_assoc()) {
		            $count = $rowc['clicks'];
		          }

				//find the word position
				$sqlc = "SELECT POSITION(\"".$ste."\" IN \"".$poste."\") AS sindex;";
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
				$cal = substr($row['post'], $sindex, $len).substr($row['post'],$sindex2, $eindex);
				if (strlen($cal) < 202) {
					$cal = "...".substr($row['post'],0, 202 - (strlen($cal)-3));
				}else{
					$cal = "";
				}


				echo '
					<a href="see/index.php?see='.$row['pid'].'">
				        <div class="leftcolumn">
				          <div class="card">
			                <h2><i class="fa fa-eye" aria-hidden="true" style="float:right;font-size:18px">'.$count.'</i></h2>

			                
			                <div class="fakeimg"><h2 style="text-align:center;margin: auto;">'.$row['title'].'</h2></div>
				            <p><b>'.substr($row['post'], $sindex, $len).'</b>'.substr($row['post'],$sindex2, $eindex).''.$cal.'</p>
				          </div>
				        </div>
			        </a>';
			}
		}else{
			echo '<h1 style="text-align:center">No Suggested <br>:(</h1>';
		}
		
	}elseif ($sr == "") {
		if ($cs == "all") {
			$sql = "SELECT * FROM post WHERE status = 1 ORDER BY pid DESC";
		}else{
			$sql = "SELECT * FROM post WHERE status = 1 AND cat = '$cs' ORDER BY pid DESC";
		}
		$result = $con->query($sql);
		if ($result ->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {

	          $sqlc = "SELECT * FROM usec WHERE pid='".$row['pid']."'";
	          $resultc = $con->query($sqlc);
	          if ($rowc = $resultc->fetch_assoc()) {
	            $count = $rowc['clicks'];
	          }

				echo '
					<a href="see/index.php?see='.$row['pid'].'">
				        <div class="leftcolumn">
				          <div class="card">
			                <h2><i class="fa fa-eye" aria-hidden="true" style="float:right;font-size:18px">'.$count.'</i></h2>

			                
			                <div class="fakeimg"><h2 style="text-align:center;margin: auto;">'.$row['title'].'</h2></div>
				            <p>'.substr($row['post'], 0, 202).'</p>
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