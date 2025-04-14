<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Jamie's Travels</title>
    <style>
        body {
            margin: 0;
        }

        #map {
            width: 100%;
            min-height: 100vh;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3FIG6Hrevw5fiybeRDTAQRaEc8SQb8aA&loading=async&callback=initMap&libraries=marker" defer></script>
    <script>
        // Initialize the map
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 60.0648, lng: 11.8652 },
                zoom: 4,
                mapTypeId: "hybrid",
                mapId: 'YOUR_MAP_ID',
            });

            // Define the points
            const points = [
	
<?php

	$fields = ["lat", "lng", "place", "link", "pic"];
	$data = file_get_contents("data.csv");
	$lines = preg_split("/\n/", $data);
	foreach($lines as $line) {
		if (trim($line) != "")
		{
			$facts = explode(",", $line);
			$newline = "";
			for ($i = 0; $i < 5; $i++) {
				if ($i < count($facts)) {
					$newline = "$newline, $fields[$i]: $facts[$i]";
				} else {
					$newline = "$newline, $fields[$i]: undefined";
				}
			}
			$newline = substr($newline, 1);
			echo "  {{$newline }},\n";
		}
	}

?>

            ];

            // Add markers to the map
            points.forEach((point) => {
                const marker = new google.maps.marker.AdvancedMarkerElement({
                    position: { lat: point.lat, lng: point.lng },
                    map: map,
                    title: point.place,
                });

                // Add an info window with links and images
                const infoWindowContent = `
    <div>
      <h3>${point.place}</h3>
      ${point.pic != undefined
                        ? `<a href="https://blog.kitten-x.com/search/label/${point.place.toLowerCase()}">${point.place}</a>
                            <center><a href="https://www.flickr.com/photos/jamiekitson/tags/${point.place}/"><img src="${point.pic}"></a></center>`
                        : `<a href="https://blog.kitten-x.com/search/label/${point.place.toLowerCase()}">${point.place}</a><br><a href="https://www.flickr.com/photos/jamiekitson/tags/${point.place}/">Pics</a></center>`
                    }
    </div>
  `;

                const infoWindow = new google.maps.InfoWindow({
                    content: infoWindowContent,
                });

                marker.addListener("gmp-click", () => {
                    infoWindow.open(map, marker);
                });
            });

            // Draw a polyline connecting the points
            const polyline = new google.maps.Polyline({
                path: points.map((point) => ({ lat: point.lat, lng: point.lng })),
                geodesic: true,
                strokeColor: "#FF0000",
                strokeOpacity: 1.0,
                strokeWeight: 2,
            });

            polyline.setMap(map);
        }
    </script>
</head>

<body>
    <div id="map"></div>
</body>

</html>
