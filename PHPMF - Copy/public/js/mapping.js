function initialize(woeid) {
	$.ajax({                       
     url: "http://127.0.0.1:8000/php/api/getCities.php",
     type: 'get',
     cache: false,
     success: function (overallArray) {
			for(var i = 0; i < overallArray.length; i++){
				if (overallArray[i].woeid == woeid){
					var cityArray = overallArray[i];
					break;
				}
			}

		    var cityHashTags = cityArray.hashTags.split(";");

			document.getElementById("cityTitle").innerHTML = cityArray.name;
			document.getElementById("rssLink").href = "php/getRssFeed.php?woeid=" + cityArray.woeid;
			document.getElementById("cityDescription").innerHTML = cityArray.desc;
			document.getElementById("cityPopulation").innerHTML = `Population: ${cityArray.curPop}`;
			document.getElementById("cityCountry").innerHTML = `Country: ${cityArray.country}`;
			document.getElementById("cityLat").innerHTML = `Lat : ${cityArray.lat}`;
			document.getElementById("cityLong").innerHTML = `Long : ${cityArray.lng}`;

			for (var j = 0; j < cityHashTags.length; j++) {
				document.getElementById("cityTwitter").innerHTML += "<a href='https://twitter.com/search?q=" + cityHashTags[j] +  "' target='_blank'>#" + cityHashTags[j] + "</a>&nbsp&nbsp";
			}

			if (0 < cityArray.images.length)
			{
				for (var i = 0; i < cityArray.images.length; i++)
				{
					document.getElementById("cityPhotos").innerHTML +='<div class="w3-display-container mySlides w3-animate-opacity"><img src="pictures/images' + cityArray.images[i].imageFle + '" style="width:100%;height:100%;"><h4>'+ cityArray.images[i].name +'</h4><p style="text-align:center;">' + cityArray.images[i].desc + '</p></div>';
				}
			}

			var mapCanvas = document.getElementById('mapCanvas');
			var mapOptions = {
			  center: new google.maps.LatLng(cityArray.lat,cityArray.lng),
			  zoom: 13,
			  mapTypeId: google.maps.MapTypeId.TERRAIN,
			  disableDefaultUI: 1
			}
			var map = new google.maps.Map(mapCanvas, mapOptions);
			setMarkers(map, cityArray.poi);
	     }
	});
}

function setMarkers(map, poiArray) 
{
	var shape = {
		  coords: [1, 1, 1, 20, 18, 20, 18 , 1],
		  type: 'poly'
	};
	for (var i = 0; i < poiArray.length; i++)
	{
	    var myLatLng = new google.maps.LatLng(poiArray[i].lat, poiArray[i].lng);
		var image = {
			url: 'pictures/mapIcons/' + poiArray[i].mapIconFle,
			size: new google.maps.Size(32, 32),
			origin: new google.maps.Point(0,0),
			anchor: new google.maps.Point(0, 32)
		};

	    var marker = new google.maps.Marker({
	        position: myLatLng,
	        map: map,
	        icon: image,
	        shape: shape,
	        title: poiArray[i].name,
	        zIndex: 99999
	    });

		// Make an array of the data from the hashtags within poi
	    var poiHashTags = poiArray[i].hashTags.split(";");

		// initializing message string
		var message = "";
	
		// Adding name and description to message
		message +=  '<div class="infobox"><h4 style="color:#000;" >' + poiArray[i].name + '</h4></br>';
		message += "<p>" + poiArray[i].desc + "</p><hr>";
		
		// Adding all of the hashtag links to message from poi
		message +=  "<h6 style='color:#000;'>Twitter Hash Tags</h6><div style='max-width:250px;'>";
		for (var j = 0; j < poiHashTags.length; j++) 
		{
			message += "<a href='https://twitter.com/search?q=" + poiHashTags[j] +  "' target='_blank'>#" + poiHashTags[j] + "</a>&nbsp&nbsp";
		}
		// Adding wiki link to message
		message += "</div><hr><h6 style='color:#000;'>Wikipedia Page</h6>";
		message += "<a href='" + poiArray[i].wikiURL +  "'>" + poiArray[i].wikiURL + "</a></br></div>";
		
	    attachMessage(marker, message, poiArray[i].poi_id);
	}
}

function attachMessage(marker, message, poi_id) {
	var infoWindowTimeout;
    var infoWindow = new google.maps.InfoWindow({
      pane: "floatPane",
      content: message
    });

	marker.addListener("mouseover", function () {
		  console.log("Mouse Over Marker");
		  infoWindow.open(marker.get('map'), marker);
	});

	marker.addListener("mouseout", function () {
		  console.log("Mouse Out Marker");
	    infoWindowTimeout = setTimeout(function(){
	        infoWindow.close();
	    }, 500);
	});
    
    marker.addListener('click', function() {
		var opened = window.open("php/pointOfInterest.php?poi_id=" + poi_id); //getPointOfInterest.php?poi_id="
	});//{{ asset('php/getPointofInterest.php?poi_id=') }}
	
	infoWindow.addListener('domready', function(){
	     $('.infobox').on('mouseenter', function(){
	         clearTimeout(infoWindowTimeout);
	     }).on('mouseleave', function(){
	         clearTimeout(infoWindowTimeout);
	         infoWindow.close();
	     });
	});
    
}