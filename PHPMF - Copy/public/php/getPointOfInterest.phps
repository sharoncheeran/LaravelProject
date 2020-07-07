<?php
/*=============================================================================
|      Editors:  Martyn Fitzgerald - 16025948
|                Sharon Cheeran    - 17012330
|                Sharmin J Rony    - 16025948
|                Josh Boyce        - 16025948
|
|  Module Code:  UFCFV4-30-2
| Module Title:  Data, Schemas & Applications
|                
|   Instructor:  Prakash Chatterjee / Glyn Watkins
|     Due Date:  14/03/2019
|
|  Description: ################################################
|                 
*===========================================================================*/
if(isset($_REQUEST["poi_id"])) { 
	$POI_ID = $_REQUEST["poi_id"]; 

	include 'login.php'; //inlcude connection file
    $poi_sql = "SELECT * FROM poi WHERE POI_ID = $POI_ID";
    $result_poi_sql = $conn->query($poi_sql);

    if ($result_poi_sql->num_rows > 0) {
        if ($row = $result_poi_sql->fetch_assoc()) {
            $poiName = $row["Name"];
            $poiDescription = $row["Description"];
            $poiWikipedia = $row["Wiki_URL"];
            $poiHashTagsOutput = '';
            $poiImages = '';

            if (substr( $poiWikipedia, 0, 10 ) === "https://en")
            {
                $poiTitle = preg_replace('#^https?://en.wikipedia.org/wiki/#', '', $poiWikipedia);

                $JsonResponse = json_decode(file_get_contents("https://en.wikipedia.org/w/api.php?action=query&format=json&prop=extracts&exintro=1&explaintext=1&titles=" . $poiTitle),true);
            }
            else if (substr( $poiWikipedia, 0, 10 ) === "https://fr")
            {
                $poiTitle = preg_replace('#^https?://fr.wikipedia.org/wiki/#', '', $poiWikipedia);

                $JsonResponse = json_decode(file_get_contents("https://fr.wikipedia.org/w/api.php?action=query&format=json&prop=extracts&exintro=1&explaintext=1&titles=" . $poiTitle),true);
            }

            $JsonPage = $JsonResponse["query"]["pages"];

            foreach ($JsonPage as $key => $value) {
                if (preg_match('/^[0-9]/', $key)) {
                    //Removing data that isnt needed.
                    unset($JsonPage[$key]["ns"]);
                    unset($JsonPage[$key]["pageid"]);

                    $JsonData = $JsonPage[$key]["extract"];
                  }
            }

            $poiHashTags = preg_split("/;/", $row["HashTags"]);

            for ($i = 0; $i < count($poiHashTags); $i++) 
            {
                $poiHashTagsOutput .= "<a href='https://twitter.com/search?q=" . $poiHashTags[$i] .  "' target='_blank'>#" . $poiHashTags[$i] . "</a> &nbsp; &nbsp;";
            }

            $poi_images_sql = "SELECT * FROM images WHERE POI_ID = $POI_ID";
            $result_poi_images_sql = $conn->query($poi_images_sql);

            if ($result_poi_images_sql->num_rows > 0) {
                while ($row_images = $result_poi_images_sql->fetch_assoc()) 
                {
                   $poiImages .= "<div class='w3-display-container mySlides w3-animate-opacity'>
                    <img alt='". $row_images["Title"] . "' src='pictures/poi/" . $row_images["Fle"] . "' style='width:100%;height:100%;'/><h4>" . $row_images["Title"] . "</h4><p style='text-align:center;'>" . $row_images["Description"] . "</p></div>";
                }
            }
	    }
    }  
} 
?>