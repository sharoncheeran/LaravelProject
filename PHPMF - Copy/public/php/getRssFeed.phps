<?php

if(isset($_REQUEST["woeid"])) { 
	$woeid = $_REQUEST["woeid"]; // Gets the ID of the city and passes it onto the function
	rssFeed($woeid);
}

function rssFeed($woeid) {
	include 'login.php'; //inlcude connection file
	
	$city_sql = "SELECT * FROM city WHERE Woeid = $woeid";  //SQL Statement for getting everything from city table & storing into variable
	$result_city_sql = mysqli_query($conn, $city_sql);    //Storing both connection and SQL into a variable via the function

	if (mysqli_num_rows($result_city_sql) > 0) {  //If statement to check if the row is bigger than 0

		if($row = mysqli_fetch_assoc($result_city_sql)) {  // storing into variable the result  
			echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><rss version=\"2.0\"><channel><place>" . $row["Name"] . "</place><Lattitude>" . $row["Lat"] . "</Lattitude><Longitude>" . $row["Lng"] . "</Longitude></channel>" ; //printing as XML with the City name, lat and long
		}
	}

	$sql = "SELECT Name, Description FROM poi WHERE Woeid = $woeid"; //SQL Query to get Name & Description from POI Table and storing to variable
	$result = mysqli_query($conn, $sql); //Storing to result
		
	if (mysqli_num_rows($result) > 0) { //if more than 0 result found then proceed to while loop		
					
		while($row = mysqli_fetch_assoc($result)) {  	//Loop to print out all the appropriate items
			echo  "<item><POI>" . $row["Name"]. "</POI><Description>" . htmlspecialchars($row["Description"]). "</Description></item>";
		}

		echo "</rss>";
	}
}
?>