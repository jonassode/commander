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
		var selected_color = undefined;
		var map = undefined;

		function draw_selected_color(color){

			selected_color = color;
			var text = "<div class='square' style='background-color:"+COLORS[color]+"; border:1px dashed gray;' >&nbsp;</div>";

			document.getElementById('selected_color').innerHTML = text;

		}

		function get_string_from_matrix(matrix){

			var text = "";

			for ( var row = 0; row < matrix.length; row++){
				for ( var col = 0; col < matrix[row].length; col++){
					if ( matrix[row][col] != undefined ){
						text = text + matrix[row][col];
					}
				}
			}
			
			return text;
		}

		function update_map(row, col, div){
			if ( selected_color != undefined ){
				map[row][col] = selected_color;
				div.style.backgroundColor = COLORS[selected_color];
			}			
		}

		function draw_map(size, name, value){		

			var text = "<b>"+name+"</b><br><table border='0'>";
			var counter = 0;
			map = Array(size);
		
			for( var row = 0; row < size; row++) {
				text = text + "<tr>"
				map[row] = Array(size);

		        	for( var col = 0; col < size; col++) {

					var content = "&nbsp;";
					var letter = value[counter];
					var color = "#C0C0C0";
					if ( letter != undefined ){
						color = COLORS[letter];
						map[row][col] = letter;
					}


					counter++;
		                	text = text + "<td><div onclick=\"update_map("+row+","+col+", this);\" class='square' style='background-color:"+color+"; border:1px dashed gray;' >"+content+"</div></td>";
			        }
				text = text + "</tr>";
			}
			text = text + "</table>";

			document.getElementById('test_area').innerHTML = text;
		}

</script>

<b>Environments</b>
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


	// Save if we have a value
	$value = $_GET['value']; 
	if ( $value != null ){
		if (mysql_query("UPDATE map SET value = '".$value."' WHERE id = ".$map_id.";")){
			// Update some note, with jquery?
		} else {
			echo "Error updateing value database: " . mysql_error();			
		}
	}

	$result = mysql_query("SELECT * FROM environment");
	echo "<table>";
	while($row = mysql_fetch_array($result))
	  {
		echo "<tr><td onclick='draw_selected_color(\"".$row['id']."\");'><span style='background-color:".$row['color'].";border:1px solid;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> ";
	  echo $row['name'];
	  echo "</td></tr>";
		echo "<script>COLORS['".$row['id']."'] = '".$row['color']."';</script>";
	  }
	echo "</table>";
	echo "<br/>";
	echo "Selected color: <div id='selected_color'>&nbsp;</div>";

	$result = mysql_query("SELECT * FROM map WHERE ID = " . $map_id );
	$row = mysql_fetch_array($result);

	echo "<script>draw_map(".$row['size'].", '".$row['name']."', '".$row['value']."');</script>";

	mysql_close($con);

}
?>

<br>
<br>
<button onclick="self.location='map.php?id=' + <?php echo $map_id ?> + '&value=' + get_string_from_matrix(map);">Save</button><br>
<a href="maps.php">Back to maps</a>

</html>

