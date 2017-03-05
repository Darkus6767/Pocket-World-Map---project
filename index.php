<!DOCTYPE html>
<?php
session_start();
$username=$_SESSION['id'] ;
?>
<html>
    <head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<link rel="stylesheet" href="assets/css/login_style.css" type="text/css" />    
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		
  <!--       <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script> 
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVtnvK6oPtm7mEol6V11ruo4nReAjCmoE"></script>
        <link rel="stylesheet" href="css/jquery-ui-1.8.18.custom.css"/>
		 <body onload="initialize()">
		 --> 
		 </head>
		 
		 <body>
		 <script src="assets/js/jquery-3.1.1.min.js"></script>
		 
		 

		</form>
	</div>
	



		<div id="menu">
		<a href="login.php"><button type="submit" >Home</button></a>
		<a href="us.html" >  <button type="submit" >About Us</button> </a>
		<a href="about.html"> <button type="submit">Project</button></a>
		</div>

		<div id="logout">
			<form  name="form1" method="post" action="php/logout.php">
			<input name="submit4" type="submit"  class="main" value="Log Out"> 
			</form>
		</div>
	
		<div id="title">
				Pocket World Map
				<hr width="20%" />
		</div>

	
	
	
	<input id="searchInput" class="controls" type="text" placeholder="Enter a location">
<div id="map"></div>


<ul id="geoData">
    <li><b>Full Address:</b> <span id="location"></span></li>
   <!-- <li>Postal Code: <span id="postal_code"></span></li> -->
    <li><b>Country:</b> <span id="country"></span></li>
    <li><b>Latitude:</b> <span id="lat"></span></li>
    <li><b>Longitude:</b> <span id="lon"></span></li>
</ul>

	


		<form action="php/save.php" method="POST" style="display: inline;">
		<div id="select_marker" class="styled-select">
			<select name="icon">
				<option value="mm_20_yellow.png"> I was there</option>
				<option value="mm_20_blue.png">I want to visit </option>
				<option value="mm_20_red.png">My own marker</option>
			</select>			
		</div>

		

			<div id="value">
			
			</div>
			
<div id="send">
		 <?php
  if(isset($_SESSION['blad_sql']))	echo $_SESSION['blad_sql'];
   unset($_SESSION['blad_sql']);
  ?>
</br>
	<input type="submit"    value="Send Markers">
	</form>
</div>

<div id="cancel">
<form method="post" action=" " onSubmit="window.location.reload()" style="display: inline;">
<input type="submit" value="Cancel">
</form>

</div>	
<script>

var map ;
var iconBase = ' http://labs.google.com/ridefinder/images/';
var marker = [];

function initMap() {

     map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 54.20, lng: 20.59},
      zoom: 5,
	  mapTypeiD: 'roadmap'
    });
	

	
		$.get(
					'php/dane.php', 
					function(dane)
					{
						var daneJSON = eval('('+dane+')'); // parsowanie

						for(var i=0; i<daneJSON.length; i++)
						{
							var lat			=	daneJSON[i].lat; // nie ma potrzeby konwertowania do liczby zmiennoprzecinkowej
							var lon			=	daneJSON[i].g_long;
							var nazwa		=	daneJSON[i].description;
							var place      = daneJSON[i].place;
							var icon 		= daneJSON[i].Icon;
							var user_id   =daneJSON[i].user_id;
							var id 			=daneJSON[i].id;
							
							//document.write(icon);
							

						if(user_id==<?php echo $_SESSION['id']?>)	addMarker(lat,lon,nazwa,place,icon,user_id,id);
				
						}

					//	alert('Wczytano '+daneJSON.length+' markerów z pliku dane.php');
					}); 
			
		
	
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });
	
	var locationsCounter = 0;
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    
        var address = '';
        if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
      
        //Location details
        for (var i = 0; i < place.address_components.length; i++) {
            if(place.address_components[i].types[0] == 'postal_code'){
                document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            }
            if(place.address_components[i].types[0] == 'country'){
                document.getElementById('country').innerHTML = place.address_components[i].long_name;
            }
        }
        document.getElementById('location').innerHTML = place.formatted_address;
        document.getElementById('lat').innerHTML = place.geometry.location.lat();
        document.getElementById('lon').innerHTML = place.geometry.location.lng();
		
		var stringValue = '<input name="value[' + 
			locationsCounter + '][0]" type="hidden" value="' +
			place.geometry.location.lat()  +
			'" ><input name="value[' +
			locationsCounter +
			'][1]" type="hidden" value="' +
			place.geometry.location.lng() + '" >Place:<input name="value[' 
			+ locationsCounter + '][2]" type="text" value="' +  place.formatted_address +
			'">Description:<input name="value[' +
			locationsCounter +
			'][3]" type="text"/></br>'
			locationsCounter++;
		
		$("#value").append(stringValue);
		
    });
	}
	 


     function addMarker(lat,lon,nazwa,place,icon,user_id,id) {
		 
	
          marker[id] = new google.maps.Marker({
		  
			position: new google.maps.LatLng(lat,lon),
			map: map,
			icon: iconBase+icon
		  });


		var nazwa2="'"+nazwa+"'";
		var place2= "'"+place+"'";
		
		  
		  var  marker_delete_string='</br><form action = "php/delete_marker.php" method = "post" style="display: inline-block;"> <input type="hidden" name="sql_id" value="'+id+'"> <input name="submit4" type="submit"  class="infowindow" value="Remove"></form>';
		  var marker_desc_edit='<button class="infowindow" onclick="My('+id+','+nazwa2+')">Edit</button>';
		  
		   marker[id].infowindow = new google.maps.InfoWindow({
          content: '<b>'+place+'</b></br></br>'+nazwa+marker_delete_string+marker_desc_edit
				});
		  
			marker[id].addListener('click', function() {
          marker[id].infowindow.open(map, this);
		  
        });
		
	

		
				
        }
		
					function My(id_my,nazwa2)
		{
			//marker[id_my].infowindow.close(map,this);
			var history=marker[id_my].infowindow.getContent(map,this);
			var a='<button class="infowindow" style="margin-left: 2px;"onclick="window.location.reload() ">Cancel</button>';
			marker[id_my].infowindow.setContent('<form action="php/edit.php" method="POST"><input name="edit_name" type="text" value="' +nazwa2+
			'" ><input name="edit_id" type="hidden" value="' +id_my+
			'" ></br><input type="submit" class="main" style="width: 50%; display: inline-block;" value="Save Changes"><button class="main" style="width: 50%; display:inline-block;"onclick="window.location.reload() ">Cancel</button></form>');
			
			
		}

		
	
	
	</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVtnvK6oPtm7mEol6V11ruo4nReAjCmoE&libraries=places&callback=initMap">
    </script>
  </body>
</html>