<?php
include("../con.php");
if (isset($_GET['cat'])) {
  $cat = $_GET['cat'];
  session_start();
  $_SESSION['cat'] = $cat;
}else{
  header("location:../");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LIME-<?php echo $cat;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../style/navbar.css">
	<link rel="stylesheet" type="text/css" href="../style/footer.css">
	<link rel="stylesheet" href="../style/modal.css">
  <link rel="stylesheet" type="text/css" href="cat.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type="image/png" href="../img/lime.png"/>


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
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  /*position: relative;
  display: inline-block;*/
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}

</style>
</head>


<body>

<div class="fix">
<div class="topnav" style="margin-bottom: 20px;">
  <a class="active" href="../">Home</a>
  <a type="button" onclick="document.getElementById('id01').style.display='block'">About</a>
  <img src="../img/lime.png" alt="LIME">
</div> 
</div>


      <div style="padding: 40px 0 0px 0;">
        <section id="posts" class="section-bg">
          <div class="container-fluid">
                    <div class="col-md-12" style="margin-bottom: 0px;margin-top: 60px;">
                      <form class="example" style="margin:auto;/*max-width:314px*/max-width:343px" autocomplete="off">
    

                            <?php
                            if ($cat != 'fomular') {
                             
                            
                              echo '<select class="select" id="cs" onchange="searchlive(this.value)">
                                    <option value="all">ALL</option>

                                    <option value="'.$cat.'" selected>'.$cat.'</option>';
                                $sql = "SELECT cname FROM cat WHERE cname != '$cat';";
                                $result = $con->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                  echo '
                                    <option value="'.$row['cname'].'">'.$row['cname'].'</option>
                                  ';
                                }

                              echo '</select>


                                    <input type="text" placeholder="Search.." name="search2" id="search" oninput="searchlive(this.value)">
                                    
                                    
                                    <button type="button" onclick="searcht()"><i class="fa fa-search"></i></button>';
                            }else{

                              echo '<select class="select" id="csf" onchange="searchlivef(this.value)">

                                    <option value="all" selected>ALL</option>';
                                $sql = "SELECT cname FROM cat WHERE cname != '$cat';";
                                $result = $con->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                  echo '
                                    <option value="'.$row['cname'].'">'.$row['cname'].'</option>
                                  ';
                                }

                              echo '</select>


                                    <input type="text" placeholder="Search.." name="search2f" id="searchf" oninput="searchlivef(this.value)">
                                    
                                    
                                    <button type="button" onclick="searchtf()"><i class="fa fa-search"></i></button>';                             
                            }
                        ?>

                        </div>
                      </form>
                      <center>
                        <div id="grest" style="margin-top: 50px;font-size: 20px;display: none">
                          <b>wait</b> <i class="fa fa-refresh fa-spin"></i>
                        </div>

                        <div id="livesearch" style="border: 0px;background: #fff;margin-top: 0px;border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);display: block;max-width:200px;">

                        </div>
                      </center>

                    <center>
                      <div id="livesearchl" style="border: 0px;background: #fff;margin-top: 1px;border-radius: 4px;box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);display: none;max-width:200px;">
                        <table id="customers">
                          <td align="center"><i class="fa fa-refresh fa-spin"></i></td>
                        </table>
                      </div>
                    </center>
                  </div>
          </div>
        </section>
      </div>

<!--<h5>Title description, Dec 7, 2017</h5>-->
<div class="row" id="row">
    <?php
    if ($cat != 'fomular') {
    
      $sql = "SELECT * FROM post WHERE cat='$cat' AND status=1 ORDER BY pid DESC";
      $result = $con->query($sql);
      $count = 0;
      if ($result->num_rows>0) {
        while ($row = $result->fetch_array()) {

          $sqlc = "SELECT * FROM usec WHERE pid='".$row['pid']."'";
          $resultc = $con->query($sqlc);
          if ($rowc = $resultc->fetch_assoc()) {
            $count = $rowc['clicks'];
          }

          echo '
          <a href="see/index.php?see='.(int)$row['pid'].'">
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
        echo '<h1 style="text-align:center">No Result <br>:(</h1>';
      }
    }else{

      $sql = "SELECT * FROM fomu WHERE status=1 ORDER BY fid DESC";
      $result = $con->query($sql);
      $count = 0;
      if ($result->num_rows>0) {
        while ($row = $result->fetch_array()) {

          $sqlc = "SELECT * FROM fusec WHERE fid='".$row['fid']."'";
          $resultc = $con->query($sqlc);
          if ($rowc = $resultc->fetch_assoc()) {
            $count = $rowc['clicks'];
          }

          echo '
          <a href="see/index.php?see='.$row['fid'].'">
            <div class="leftcolumn">
              <div class="card">
                <h2><i class="fa fa-eye" aria-hidden="true" style="float:right;font-size:18px"> '.$count.'</i></h2>

                
                <div class="fakeimg"><h2 style="text-align:center;margin: auto;">'.$row['title'].'</h2></div>
                <p>'.substr($row['des'], 0, 202).'</p>
              </div>
            </div>
          </a>';
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
        <a href="../apk/lime.zip" download><button class="dbtn" style="margin-bottom: 10px;background-color: DodgerBlue;color: white;padding: 12px 30px;cursor: pointer;font-size: 20px;border-radius: 10px;"><i class="fa fa-download"></i> Download lime.apk</button></a>
        <a href="feed/"><button class="dbtn" style="margin-bottom: 10px;background-color: DodgerBlue;color: white;padding: 12px 30px;cursor: pointer;font-size: 20px;border-radius: 10px;"><i class="fa fa-comments"></i>Feedback</button></a>
      </div>
      <footer class="w3-container w3-teal">
        <p class="alignbro">LiMe</p>
      </footer>
    </div>
  </div>
</div>

<?php include("../footer.php"); ?>


<script type="text/javascript" src="cat.js"></script>
<script type="text/javascript" src="fom.js"></script>
</body>
</html>