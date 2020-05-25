<?php
include('../../con.php');
if (isset($_REQUEST['stl'])) 
{
	
	$stl = $_REQUEST['stl'];


		if (strlen($stl)>=2) 
		{
		//echo 'serch_text-'.$stl;

			$sql1 = "SELECT * FROM post WHERE status=1 AND (title LIKE '%$stl%' OR post LIKE '%$stl%')";
			$sql2 = "SELECT * FROM fomu WHERE status=1 AND (title LIKE '%$stl%' OR des LIKE '%$stl%' OR fomular LIKE '%$stl%')";
			
		$result1 = $con->query($sql1);
		$result2 = $con->query($sql2);
		if ($result1->num_rows>0 OR $result2->num_rows>0) 
		{
		
			while ($row = $result1->fetch_assoc()) 
			{
				$title = $row['title'];
				echo '
				<option class="live" value="'.$row['pid'].'" onclick="slive(this.value)" style="padding: 5px;max-height: 50px;white-space: normal;">
					<p style="white-space: normal;">'.$title.'</p><br>
				</option>
				';
			}
			while ($row = $result2->fetch_assoc()) 
			{
				$title = $row['title'];
				echo '
				<option class="live" value="'.$row['fid'].'" onclick="slive(this.value)" style="padding: 5px;max-height: 50px;white-space: normal;">
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
$con->close();
?>