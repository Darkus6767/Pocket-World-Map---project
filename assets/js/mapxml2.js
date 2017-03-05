
		var mapa;
		var dymek ; // zmienna globalna
		var markers = [];
		
		
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
				
				$.get(
					'/PWM/php/load.php', 
					function(dane)
					{
						var daneJSON = eval('('+dane+')'); // parsowanie

						for(var i=0; i<daneJSON.length; i++)
						{
							var lat			=	daneJSON[i].lat; // nie ma potrzeby konwertowania do liczby zmiennoprzecinkowej
							var lon			=	daneJSON[i].lng;
							var desc		=	daneJSON[i].description;
							
							dodajMarkerphp(mapa, lat, lon, desc);
						}

						alert('Wczytano '+daneJSON.length+' markerów z pliku dane.php');
					}
				);		
			  
			
				google.maps.event.addListener(mapa,'click',function(zdarzenie)
				{
					if(zdarzenie.latLng)	
					{
						dodajmojMarker(zdarzenie.latLng);
					
					}
				});

			}  
			
function wczytajMarkery()
{
				jx.load('/PWM/dane1.xml', function(xml)
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
					//alert('Wczytano '+markery.length+' markerów z pliku dane1.xml');
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
	marker.txt	=	'<strong>Wybrane państwo:<br /><strong>'+nazwa+'</strong>';
	
	google.maps.event.addListener(marker,"click",function()
	{
		dymek.setPosition(marker.getPosition());
		dymek.setContent(marker.txt);
		dymek.open(mapa);
	});
	
	
	
}


function dodajmojMarker(latlng)
{
	var marker	=	new google.maps.Marker(
		{
			position: latlng,
			icon: pobierzIkone(),
					
			map: mapa
		}
	);

	
	
	google.maps.event.addListener(marker,"click",function()
	{
		dymek.setPosition(marker.getPosition());
		dymek.setContent('<strong> I was here :) </strong>');
		dymek.open(mapa);
	});
	
	/*google.maps.event.addListener(marker,'rightclick',function()
				{
					marker.usun();
				});*/
				
				markers.push(marker);
}

/*google.maps.Marker.prototype.usun = function()
			{
				if(confirm('Czy na pewno usunąć ten marker?'))
				{
					var tab = [];
					for(var i=0; i<markers.length; i++)
					{
						if(markers[i]!=this)
							tab.push(markers[i]);
					}
					markers=tab;
					this.setMap(null);
					
				}
			}
*/		
function pobierzIkone()
{
				var rozmiar				= new google.maps.Size(32,32);
				var punkt_startowy 		= new google.maps.Point(0,0);
				var punkt_zaczepienia 	= new google.maps.Point(10,17);
				var rozmiar_cien 		= new google.maps.Size(59,32);
				
				var ikona = new google.maps.MarkerImage('http://maps.google.com/mapfiles/kml/pal2/icon5.png', rozmiar, punkt_startowy, punkt_zaczepienia);
				
				return ikona;
			}
			
			


function dodajMarkerphp(mapa, lat,lon,desc)
			{
				var marker = new google.maps.Marker
				(
					{
						map: 		mapa, 
						position: 	new google.maps.LatLng(lat, lon),
					}
				);
				
				google.maps.event.addListener(marker,'click',function(zdarzenie)
				{
					dymek.setContent('<br /><strong>' + desc + '</strong>'); 
					dymek.setPosition(marker.getPosition()); 
					dymek.open(mapa);
				});
			}			