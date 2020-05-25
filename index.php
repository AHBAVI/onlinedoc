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
	<link rel="stylesheet" type="text/css" href="style/navbar.css">
	<link rel="stylesheet" type="text/css" href="style/cat.css">
	<link rel="stylesheet" type="text/css" href="style/footer.css">
	<link rel="stylesheet" href="style/modal.css">
  <link rel="icon" type="image/png" href="img/lime.png"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<div class="allb">
<div class="fix">
  <div class="topnav">
    <a class="active" href="#home">Home</a>
    <a type="button" onclick="document.getElementById('id01').style.display='block'">About</a>
    <img src="img/lime.png" alt="LIME">
  </div> 
</div>

<div id="main" style="margin-bottom: 150px;">
	<form method="GET" action="cat/">
		<div id="sft">
			<input type="submit" name="cat" value="SFT">
		</div>
		<div id="et">
			<input type="submit" name="cat" value="ET">
		</div>
		<div id="ict">
			<input type="submit" name="cat" value="ICT">
		</div>
    <div id="fomu" style="padding: 0px">
    </div>
    <div id="fomu">
      <button type="submit" name="cat" value="fomular">Formulars(සූත්‍ර)</button>
    </div>
    <div id="fomu" style="padding: 0px;margin-bottom: 65px;">
    </div>
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


        <a href="apk/lime.zip" download><button class="dbtn" style="margin-bottom: 10px;background-color: DodgerBlue;color: white;padding: 12px 30px;cursor: pointer;font-size: 20px;border-radius: 10px;"><i class="fa fa-download"></i> Download lime.apk</button></a>
        <a href="cat/feed/"><button class="dbtn" style="margin-bottom: 10px;background-color: DodgerBlue;border: none;color: white;padding: 12px 30px;cursor: pointer;font-size: 20px;border-radius: 10px;"><i class="fa fa-comments"></i>Feedback</button></a>

      </div>

      <footer class="w3-container w3-teal">
        <p class="alignbro">LiMe</p>
      </footer>
    </div>
  </div>
</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>