function dodajMarker(map, lat,lon,nazwa)
			{
				var marker = new google.maps.Marker
				(
					{
						position: new google.maps.LatLng(lat,lon),
						map: 		map
						
					}
				);
				
		/*	google.maps.event.addListener(marker,'click',function(zdarzenie)
				{
					dymek.setContent('Wybrane pa�stwo:<br /><strong>' + nazwa + '</strong>'); 
					dymek.setPosition(marker.getPosition()); 
					dymek.open(mapa);
				});  */
			} 