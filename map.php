<html>
<head>
	<style type="text/css">
		.square {
		    float: left;
		    width:20px;
		    height:20px;
		    display:block;
		    overflow:hidden;
		}

	</style>

</head>

<script>

		// Constants
		var COLORS = new Object();

		function draw_map(size, name, value){		

			var text = "<b>"+name+"</b><br><table border='0'>";
			var counter = 0;
		
			for( var row = 0; row < size; row++) {
				text = text + "<tr>"
		        	for( var col = 0; col < size; col++) {
					var content = "&nbsp;";
					var letter = value[counter];
					var color = "#C0C0C0";
					if ( letter != undefined ){
						color = COLORS[letter];
					}

					counter++;
		                	text = text + "<td><div class='square' style='background-color:"+color+"; border:1px dashed gray;' >"+content+"</div></td>";
			        }
				text = text + "</tr>";
			}
			text = text + "</table>";

			document.getElementById('test_area').innerHTML = text;
		}

</script>

<b>Environments</b>
<table>

<div id="test_area" style="border: 3px silver solid; float:left;">a </div>

<?php

$map_id = $_GET['id']; 

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
		echo "<script>COLORS['".$row['id']."'] = '".$row['color']."';</script>";
	  }

	$result = mysql_query("SELECT * FROM map WHERE ID = " . $map_id );
	$row = mysql_fetch_array($result);

	echo "<script>draw_map(".$row['size'].", '".$row['name']."', '".$row['value']."');</script>";

	mysql_close($con);

}
?>





</table>
</html>

