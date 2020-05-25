<?php
include("../../con.php");
$msg = "";
if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $msg = $_POST['msg'];
  $name = $_POST['name'];

  $sql = "SELECT MAX(fid) AS fid FROM feed;";
  $result = $con->query($sql);
  while ($row = $result->fetch_assoc()) {
    $bid = $row['fid']+1;
  }


  $sql = "INSERT INTO feed(fid,name,email,message) VALUES('$bid','$name','$email','$msg')";
  if ($con->query($sql) == TRUE) {
    $msg = '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>Message sent successfully:)</div>';
  }else{
    $msg = '<div class="dalert"><span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>We can\'t send the message now.please try again later:(</div>';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LIME</title>
  <meta name="keywords" content="lime.ga,lime,sft,et,ict,sri lanka education,technology subjects,lime education">
  <meta name="description" content="This website is a one free education website for Technology subjects.">
  <meta name="author" content="JASHB">
  <meta name="google-site-verification" content="BS6as_bN9GEaQqJavCqLdCBoUN4CxUKwahydobss_cU" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../../style/navbar.css">
	<link rel="stylesheet" type="text/css" href="../../style/cat.css">
	<link rel="stylesheet" type="text/css" href="../../style/footer.css">
	<link rel="stylesheet" href="../../style/modal.css">
  <link rel="icon" type="image/png" href="../../img/lime.png"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text],input[type=email], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #1579db;
}

#container {
  margin: 80px 20px 50px 20px;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;
  background:rgba(241, 241, 241, 0.9);
}


.alert {
  padding: 20px;
  background-color: #2196F3;
  color: white;
  border-radius: 5px;
  margin-bottom: 10px;
}
.dalert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  border-radius: 5px;
  margin-bottom: 10px;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>

</head>

<body>

<div class="allb">
<div class="fix">
  <div class="topnav">
    <a class="active" href="../../">Home</a>
    <a type="button" onclick="document.getElementById('id01').style.display='block'">About</a>
    <img src="../../img/lime.png" alt="LIME">
  </div> 
</div>

<div id="container">
  <form action="" method="POST">
    <?php echo $msg;?>
    <label for="name">First Name</label>
    <input type="text" id="name" name="name" placeholder="Your name.." required="required">

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Your Email address..">

    <label for="subject">Message</label>
    <textarea id="subject" name="msg" placeholder="Write your message.." style="height:200px" required="required"></textarea>

    <input type="submit" value="submit" name="submit">
  </form>
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
        <a href=" "><button class="dbtn" style="margin-bottom: 10px;background-color: DodgerBlue;color: white;padding: 12px 30px;cursor: pointer;font-size: 20px;border-radius: 10px;"><i class="fa fa-comments"></i>Feedback</button></a>
      </div>

      <footer class="w3-container w3-teal">
        <p class="alignbro">LiMe</p>
      </footer>
    </div>
  </div>
</div>
</div>
<?php include("../../footer.php"); ?>
</body>
</html>