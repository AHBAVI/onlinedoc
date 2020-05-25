<?php
include("../../con.php");
if (isset($_GET['see'])) {
  $cat = $_GET['see'];

  if (substr($cat, 0,1) != 'f') {
  
    $sql = "SELECT * FROM usec WHERE pid='$cat'";
    $result = $con->query($sql);
    if ($result->num_rows>0) {
      while ($row = $result->fetch_assoc()) {
        $clicks = $row['clicks']+1;
        $sqlu = "UPDATE usec SET clicks='$clicks' WHERE pid='$cat'";
        $resultu = $con->query($sqlu);
      }
    }
    else{
      $sql = "INSERT INTO usec VALUES('$cat',1)";
      $result = $con->query($sql);
    }
  }else{
    $sql = "SELECT * FROM fusec WHERE fid='$cat'";
    $result = $con->query($sql);
    if ($result->num_rows>0) {
      while ($row = $result->fetch_assoc()) {
        $clicks = $row['clicks']+1;
        $sqlu = "UPDATE fusec SET clicks='$clicks' WHERE fid='$cat'";
        $resultu = $con->query($sqlu);
      }
    }
    else{
      
      $sql = "INSERT INTO fusec VALUES('$cat',1)";
      $result = $con->query($sql);
    }    
  }
}
else{
  header('location:../../');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LIME</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../../style/navbar.css">
	<link rel="stylesheet" type="text/css" href="../../style/footer.css">
	<link rel="stylesheet" href="../../style/modal.css">
  <link rel="stylesheet" type="text/css" href="../cat.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type="image/png" href="../../img/lime.png"/>

<style>
/*#footer {
   width: 100%;
}
@media screen and (max-width: 471px) {
  #footer{
    bottom:auto;
    width: 100%;
  }
}*/
.w3-example {
    /*border-left: 4px solid #2196F3;
    border-right: 4px solid #2196F3;*/
    padding: 8px 20px;
    margin: 24px -20px;
    box-shadow: none !important;
    border-radius: 10px;
}
.w3-example {
    background-color: #e7f3fe;
    padding: 0.01em 10px;
    margin: 20px 0;
    box-shadow: 0 2px 4px 0 rgba(73, 144, 224, 0.71),0 2px 10px 0 rgba(75, 204, 239, 0.72) !important;
    margin-top: 70px;
}
.w3-white, .w3-hover-white:hover {
    color: #000 !important;
  }
.w3-code {
    border-left: 4px solid #2196F3;
    border-right: 4px solid #2196F3;
    border-radius: 10px;
}
.w3-code a:link, a:visited {
  color: #008CBA;;
  text-decoration: underline;
  cursor: pointer;
}

.w3-code a:link:active, a:visited:active {
  color: #006A8D;
}
</style>

</head>

<body>

<div class="fix">
  <div class="topnav" style="margin-bottom: 20px;">
    <a class="active" href="../../">Home</a>
    <a type="button" onclick="document.getElementById('id01').style.display='block'">About</a>
    <img src="../../img/lime.png" alt="LIME">
  </div>
</div> 


<!--<h5>Title description, Dec 7, 2017</h5>-->
<div class="row" id="row">

<?php
  $sql = "SELECT * FROM post WHERE pid='$cat'";
  $result = $con->query($sql);
  if ($result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {
      echo '
        <div class="w3-example">
          <h3>'.$row['title'].'</h3>
          <div class="w3-code notranslate htmlHigh" style="padding: 8px 8px;">
          <span class="tagnamecolor" style="color:#006621;white-space: pre-line;font-weight: bold;">
            '.$row['post'].'
      ';

      $mn = "SELECT * FROM mention WHERE id='".$row['pid']."'";
      $resultm = $con->query($mn);
      if ($mr = $resultm->fetch_assoc() AND $result->num_rows>0) {
        $aa = explode(",", $mr['mention']);
        echo "<br><p><b>Related links to this post..</b></p>";
        foreach ($aa as $links) {
          $sql1 = "SELECT * FROM post WHERE pid='$links'";
          $sql2 = "SELECT * FROM fomu WHERE fid='$links'";

          $result1 = $con->query($sql1);
          $result2 = $con->query($sql2);
          if ($rr = $result1->fetch_assoc()) {
            echo '<p style="margin-top: 5px;margin-bottom: 5px;"><a href="../see/?see='.$rr['pid'].'">'.$rr['title'].'</a></p>';
          }
          if ($rr = $result2->fetch_assoc()) {
            echo '<p style="margin-top: 5px;margin-bottom: 5px;"><a href="../see/?see='.$rr['fid'].'">'.$rr['title'].'</a></p>';
          }
        }
        
      }

      echo '
          </span>
           </div>
        </div>
      ';
    }
  }
  else{
    $sql = "SELECT * FROM fomu WHERE fid='$cat'";
    $result = $con->query($sql);
    if ($result->num_rows>0) {
      while ($row = $result->fetch_assoc()) {
        $fomu = $row['fomular'];
        echo '
          <div class="w3-example">
            <h3>'.$row['title'].'</h3>
            <div class="w3-code notranslate htmlHigh" style="padding: 8px 8px;border-left: 4px solid #FB1911;border-right: 4px solid #FB1911;">
            <span class="tagnamecolor" style="color:#006621;white-space: pre-line;font-weight: bold;">
            <h4 style="font-weight: 900;white-space: pre;overflow: auto;color:black;text-align:center;border:2px solid #FB1911;padding:5px;border-radius:10px;">'.$row['fomular'].'<br></h4>
            <p style="text-align:center;"><button onclick="document.getElementById(\'id02\').style.display=\'block\'">View Formular</button></p>
              '.$row['des'].'
        ';

      $mn = "SELECT * FROM mention WHERE id='".$row['fid']."'";
      $resultm = $con->query($mn);
      if ($mr = $resultm->fetch_assoc() AND $result->num_rows>0) {
        $aa = explode(",", $mr['mention']);
        echo "<br><p><b>Related links to this post..</b></p>";
        foreach ($aa as $links) {
          $sql1 = "SELECT * FROM post WHERE pid='$links'";
          $sql2 = "SELECT * FROM fomu WHERE fid='$links'";

          $result1 = $con->query($sql1);
          $result2 = $con->query($sql2);
          if ($rr = $result1->fetch_assoc()) {
            echo '<p style="margin-top: 5px;margin-bottom: 5px;"><a href="../see/?see='.$rr['pid'].'">'.$rr['title'].'</a></p>';
          }
          if ($rr = $result2->fetch_assoc()) {
            echo '<p style="margin-top: 5px;margin-bottom: 5px;"><a href="../see/?see='.$rr['fid'].'">'.$rr['title'].'</a></p>';
          }
        }
        
      }

        echo '
            </span>
             </div>
          </div>
        ';
      }
    }else{
      echo '<h1 style="text-align:center">No Result <br>:(</h1>';
    }
  }
?>


</div>

<div class="w3-container">
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>About LiMe</h2>
      </header>
      <div class="w3-container" style="text-align: center;">
        <p>LiMe is a free education website for A/L Technlogy Students. </p>
        <p>All of SFT and ET data in this site copied from sft,et goverment books because of that all of SFT and ET infomation belongs to government book writers.</p>

        <a href="../../apk/lime.zip" download><button class="dbtn" style="margin-bottom: 10px;background-color: DodgerBlue;color: white;padding: 12px 30px;cursor: pointer;font-size: 20px;border-radius: 10px;"><i class="fa fa-download"></i> Download lime.apk</button></a>
        <a href="../feed/"><button class="dbtn" style="margin-bottom: 10px;background-color: DodgerBlue;color: white;padding: 12px 30px;cursor: pointer;font-size: 20px;border-radius: 10px;"><i class="fa fa-comments"></i>Feedback</button></a>

      </div>
      <footer class="w3-container w3-teal">
        <p class="alignbro">LiMe</p>
      </footer>
    </div>
  </div>

  <div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id02').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Full view of Formular</h2>
      </header>
      <div class="w3-container">
        <p style="text-align: center;"><b><?php echo $fomu;?></b></p>
      </div>
      <footer class="w3-container w3-teal">
        <p class="alignbro">LiMe</p>
      </footer>
    </div>
  </div>

</div>

<?php include("../../footer.php"); ?>


<script type="text/javascript" src="../cat.js"></script>
</body>
</html>