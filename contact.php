<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script>
      function initialize() {
	  var bryantPark = new google.maps.LatLng(50.667287, -1.56567);
	  var panoramaOptions = {
		position: bryantPark,
		pov: {
		  heading: 70,
		  pitch: -12
		},
		zoom: 1
	  };
	  var myPano = new google.maps.StreetViewPanorama(
		  document.getElementById('map'),
		  panoramaOptions);
	  myPano.setVisible(true);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
    </script>
	<script>
      function initialize() {
        var map_canvas = document.getElementById('map2');
        var map_options = {
          center: new google.maps.LatLng(50.666546, -1.565895),
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options)
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

<div id='map'></div><br>
<div id='map2'></div>
	
<p>
De Straat 1<br>
0100 PF<br>
Ergens<br>
<br><br>
email@email.nl<br>
<br><br>
Telefoon: 000 7245234<br>
Fax: 1<br>
<br><br>
<br>
<strong>Werknemers:</strong><br>
Dhr. Administrator<br>
Dhr. Werknemer<br><br>
</p>