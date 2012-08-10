<html>

<b>Environments</b>
<table>


<?php
$con = mysql_connect("meeples.se.mysql","meeples_se","gmYrpVjd");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
else {

	mysql_select_db("meeples_se", $con);

	$result = mysql_query("SELECT * FROM environment");

	while($row = mysql_fetch_array($result))
	  {
		echo "<tr><td><span style='background-color:".$row['color'].";border:1px solid;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> ";
	  echo $row['name'];
	  echo "</td></tr>";
	  }

	mysql_close($con);

}

?>
</table>
</html>

