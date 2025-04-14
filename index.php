<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <style type="text/css">
    img {border: 0}
    v\:* {
          behavior:url(#default#VML);
	 }
    </style>
    <title>Jamie's Travels</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA1MA-jz-rV58wc52_XWph8RRVZSQXK8c7siG3Tgmx_yYyaDVobxQgduSZhkJ8G1wv8yi2VorVkZonTQ"
            type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

function getWindowWidth() {
	if (window.self && self.innerWidth) 
		{return self.innerWidth;}
	if (document.documentElement && document.documentElement.clientWidth) 
		{return document.documentElement.clientWidth;}
	return 0;
}

function getWindowHeight() {
	if (window.self && self.innerHeight) 
		{return self.innerHeight;}
	if (document.documentElement && document.documentElement.clientHeight) 
		{return document.documentElement.clientHeight;}
	return 0;
}

function resizeApp() {
	var offsetTop = 0;
	var mapElem = document.getElementById("map");
	for (var elem = mapElem; elem != null; elem = elem.offsetParent) {
		offsetTop += elem.offsetTop;
	}
	var height = getWindowHeight() - offsetTop - 10;
	if (height >= 0) {
		mapElem.style.height = height + "px";
//		e("panel").style.height = (height + 4) + "px";
	
	}
	var width = getWindowWidth() - offsetTop - 10;
	if (width >= 0) {
		mapElem.style.width = width + "px";
	}


}



function createMarker(point, place, link, pic) {
  var marker = new GMarker(point);

if (pic != "undefined") {
var infoTabs = [
  new GInfoWindowTab("Desc", "<a href=\"http://blog.kitten-x.com/search/label/" + place.toLowerCase() + "\">" + place + "<\/a>"),
  new GInfoWindowTab("Pic", "<center><a href=\"http://www.flickr.com/photos/jamiekitson/tags/" + place + "/\"><img src=\"" + pic + "\"></a></center>")
]; } else {
var infoTabs = [
  new GInfoWindowTab("Desc", "<a href=\"http://blog.kitten-x.com/search/label/" + place.toLowerCase() + "\">" + place + "<\/a><br><a href=\"http://www.flickr.com/photos/jamiekitson/tags/" + place + "/\">Pics</a></center>")
];
}

/*
if (pic != "undefined") {

var infoTabs = [
  new GInfoWindowTab("Desc", "<a href=\"" + link + "\">" + place + "<\/a>"),
  new GInfoWindowTab("Pic", "<center><a href=\"" + link + "\"><img src=\"" + pic + "\"></a></center>")
];

} else if (link != "undefined") {
var infoTabs = [
  new GInfoWindowTab("Desc", "<a href=\"" + link + "\">" + place + "<\/a>")
];

} else { 
var infoTabs = [
  new GInfoWindowTab("Desc", place)
];
} 
*/

  GEvent.addListener(marker, "click", function() {
    marker.openInfoWindowTabsHtml(infoTabs);
  }); 

  return marker;
}

function getArray(ain) {
	var aout = [];
	for (i = 0; i < ain.length; i++)
		aout.push(ain[i].point);
	return aout;
}

function pointerClass() {}

function createPointer(lat, lng, place, link, pic) {
	var apoint = new pointerClass;
	apoint.point = new GLatLng(lat, lng);
	apoint.lat = lat;
	apoint.lng = lng;
	apoint.link = link;
	apoint.place = place;
	apoint.pic = pic;
	return apoint;
}

    function load() {

	resizeApp();

      if (GBrowserIsCompatible()) {
        
	var map = new GMap2(document.getElementById("map"));
	
	map.addControl(new GLargeMapControl());
        map.addControl(new GMapTypeControl());
        map.setCenter(new GLatLng(60.06484046010452, 11.865234375), 4);
	map.setMapType( G_HYBRID_MAP );
	
	var points = [];
	var glatlongs = [];
	var links = [];
	var place = [];
	var info = [];
	var i = 0;
	
<?php

	$data = file_get_contents("data.csv");
	$lines = split("\n", $data);
	foreach($lines as $line) {
		if (trim($line) != "")
		{
			$facts = explode(",", $line);
			$newline = "";
			for ($i = 0; $i < 5; $i++) {
				if ($i < count($facts)) {
					$newline = "$newline,$facts[$i]";
				} else {
					$newline = "$newline,'undefined'";
				}
			}
			$newline = substr($newline, 1);
//			$newline = $newline."jamie";
			echo "  points.push(createPointer($newline));\n";
//			echo "	points.push(createPointer($line));\n";
		}
	}

?>
	for (i = 0; i < points.length; i++) {
	  	map.addOverlay(new GMarker(points[i].point));
		map.addOverlay(createMarker(points[i].point, points[i].place, points[i].link, points[i].pic));
//		glatlongs.push(new GLatLng(points[i].lat, points[i].lng));
	}

//	map.addOverlay(new GPolyline(glatlongs));
	map.addOverlay(new GPolyline(getArray(points)));
        
	map.setCenter(new GLatLng(points[i - 1].lat, points[i - 1].lng), 5);


/*        GEvent.addListener(map, "moveend", function() {
          var center = map.getCenter();
          document.getElementById("message").innerHTML = center.toString();
        });
*/
	GEvent.addListener(map, "dblclick", function(marker, point) {
        	map.setCenter(point);
	});



      }
        
    }

    //]]>
    </script>
  </head>

  <body onload="load()" onunload="GUnload()">
    <div id="map" style="width: 700px; height: 500px"></div>
    <div id="message"></div>
  </body>
</html>
