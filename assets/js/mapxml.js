
		var mapa;
		var dymek ; // zmienna globalna
		
			function mapaStart()  
			{  
				var wspolrzedne = new google.maps.LatLng(53.429805, 14.537883);
				var opcjeMapy = {
					zoom: 3,
					center: wspolrzedne,
					mapTypeId: google.maps.MapTypeId.SATELLITE,
					//disableDefaultUI: true
					  panControl: true,
                    zoomControl: true,
                    scaleControl: true,
                   
                    streetViewControl: true,
					mapTypeControl: true,
					 mapTypeControlOptions:
                  
                  {
                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU // w stylu rozwijanego menu
                    }
				};
				mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy); 			
				dymek = new google.maps.InfoWindow();
				
				wczytajMarkery();

			}  
			
			function wczytajMarkery()
			{
				jx.load('/dane1.xml', function(xml)
				{
					var markery = xml.getElementsByTagName("marker");
					for(var i=0; i<markery.length; i++)
					{
						var lat			=	parseFloat(markery[i].attributes.getNamedItem("lat").nodeValue);
						var lon			=	parseFloat(markery[i].attributes.getNamedItem("lon").nodeValue);
						var ikona_url	=	markery[i].attributes.getNamedItem("ikona").nodeValue;
						var nazwa		=	markery[i].attributes.getNamedItem("nazwa").nodeValue;
						var marker		=	dodajMarker(lat,lon,ikona_url,nazwa);
					}
					alert('Wczytano '+markery.length+' markerów z pliku dane1.xml');
				},'xml','get');
			}
		
function dodajMarker(lat,lon,ikona_url,nazwa)
{
    var rozmiar = new google.maps.Size(30,23);   
    var punkt_startowy = new google.maps.Point(0,0);   
    var punkt_zaczepienia = new google.maps.Point(15,12);   
       
    var ikona = new google.maps.MarkerImage(ikona_url, rozmiar, punkt_startowy, punkt_zaczepienia); 
	
	var marker	=	new google.maps.Marker(
		{
			position: new google.maps.LatLng(lat,lon),
			title: nazwa,
			icon: ikona,
			map: mapa
		}
	);
	marker.txt	=	'Wybrane państwo:<br /><strong>'+nazwa+'</strong>';
	
	google.maps.event.addListener(marker,"click",function()
	{
		dymek.setPosition(marker.getPosition());
		dymek.setContent(marker.txt);
		dymek.open(mapa);
	});
	return marker;
}
		
