<b>Maps</b><br>
<br>

<?php
$con = mysql_connect("meeples.se.mysql","meeples_se","gmYrpVjd");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
else {

	mysql_select_db("meeples_se", $con);

	$result = mysql_query("SELECT * FROM map");

	while($row = mysql_fetch_array($result))
	  {
	  echo "<a  href='map.php?id=" . $row['id'] . "'>" . $row['name'] . "</a>";
	  echo "<br/>";
	  }

	mysql_close($con);

}

?>
