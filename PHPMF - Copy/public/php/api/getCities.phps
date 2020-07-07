<?php

include('../login.php');

$sql = "SELECT * from city";

$sql_result = $conn->query($sql);

$city = [];

if ($sql_result->num_rows > 0) {
	while ( $row = $sql_result->fetch_assoc()) {
		$poi = [];
		$woi_images = [];
		$woeid = $row["Woeid"];

		$sql_poi = "SELECT poi.*, category.Map_Icon_Fle FROM poi INNER JOIN category ON poi.Cat_ID = category.Cat_ID WHERE Woeid = $woeid";

		$sql_result_poi = $conn->query($sql_poi);

		if ($sql_result_poi->num_rows > 0) {
			while ($rowPOI = $sql_result_poi->fetch_assoc()) {
				$tempPOI = array(
                    'poi_id' => $rowPOI["POI_ID"],
					'name' => $rowPOI["Name"],
					'lat' => $rowPOI["Lat"],
					'lng' => $rowPOI["Lng"],
					'desc' => $rowPOI["Description"],
					'hashTags' => $rowPOI["HashTags"],
					'wikiURL' => $rowPOI["Wiki_URL"],
					'mapIconFle' => $rowPOI["Map_Icon_Fle"]
				);
				array_push($poi, $tempPOI);
			}
		}

		$sql_woi_images = "SELECT * FROM images WHERE Woeid = $woeid";

		$sql_result_woi_images = $conn->query($sql_woi_images);

		if ($sql_result_woi_images->num_rows > 0) {
			while ($row_woi_images = $sql_result_woi_images->fetch_assoc()) {
				$temp_woi_images = array(
					'name' => $row_woi_images["Title"],
					'desc' => $row_woi_images["Description"],
					'imageFle' => $row_woi_images["Fle"]
				);
				array_push($woi_images, $temp_woi_images);

			}
		}
		$tempCity = array( 
			'woeid' =>$row["Woeid"],
			'name' => $row["Name"],
			'desc' => $row["Description"],
			'lat' => $row["Lat"],
			'lng' => $row["Lng"],
			'curPop' => $row["CurrentPopulation"],
			'hashTags' => $row["HashTags"],
			'country' => $row["Country"],
			'images' => $woi_images,
			'poi' => $poi
		);
		array_push($city, $tempCity);
	}
}

$conn->close();

header('Content-Type: application/json; charset=utf-8');
echo  json_encode($city);

//echo  '<pre>';
//echo  json_encode($city, JSON_PRETTY_PRINT);
//echo  '</pre>';

?>