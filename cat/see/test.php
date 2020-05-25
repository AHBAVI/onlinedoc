<?php
include("../../con.php");
/*echo "ahb";
$text = "à·ƒà·’à¶‚à·„à¶½ à¶ºà¶±à·”";
echo utf8_encode("සිංහල යනු");
$str = mb_convert_encoding("සිංහල යනු", "UTF-8", "latin1");
echo $str;
echo strlen($text)."<br>".strlen($str);*/

$str1 = "සිංහල";
$str2 = "යනු සිංහල ප්‍රක්‍රිට් යනු";

$stre1 = utf8_encode($str1);
$stre2 = utf8_encode($str2);

$sql = "SELECT POSITION('$stre1' IN '$stre2') AS MatchPosition;";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
	echo $row['MatchPosition'];
	echo substr($str2, $row['MatchPosition']-1,strlen($str1));
}
echo "<br>".strlen($str1);

?>