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

	// Save if we have a value
	$value = $_GET['new']; 
	if ( $value != null ){
		if (mysql_query("INSERT INTO  map (name ,size)VALUES ('".$value."',  '30');")){
			// Update some note, with jquery?
		} else {
			echo "Error creating new map: " . mysql_error();			
		}
	}

	$result = mysql_query("SELECT * FROM map");

	while($row = mysql_fetch_array($result))
	  {
	  echo "<a  href='map.php?id=" . $row['id'] . "'>" . $row['name'] . "</a>";
	  echo "<br/>";
	  }

	mysql_close($con);

}

?>

<button onclick="self.location='maps.php?new=' + prompt('Please enter name of new map','');">Create new map</button><br>


