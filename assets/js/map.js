
		var mapa;
		var dymek = new google.maps.InfoWindow(); // zmienna globalna
		
		function dodajMarker_icon(opcjeMarkera,txt)
		{
			// tworzymy marker
			opcjeMarkera.map = mapa; 
			var marker = new google.maps.Marker(opcjeMarkera);
			marker.txt=txt;
			
			google.maps.event.addListener(marker,"click",function()
			{
				dymek.setContent(marker.txt);
				dymek.open(mapa,marker);
			});
			return marker;
		}

	function dodajMarker_cloud(lat,lng,txt)
		{
			// tworzymy marker
			var opcjeMarkera =   
			{  
				position: new google.maps.LatLng(lat,lng),  
				map: mapa
			}  
			var marker = new google.maps.Marker(opcjeMarkera);
			marker.txt=txt;
			
			google.maps.event.addListener(marker,"click",function()
			{
				dymek.setContent(marker.txt);
				dymek.open(mapa,marker);
			});
			return marker;
		}
		
		function mapaStart()   
		{   
			var wspolrzedne = new google.maps.LatLng(53.434185236286325,14.512596130371094);
			var opcjeMapy = {
			  zoom: 4,
			  center: wspolrzedne,
			  mapTypeId: google.maps.MapTypeId.SATELLITE
			};
			
			mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy); 
			var rozmiar = new google.maps.Size(30,23);
				var punkt_startowy = new google.maps.Point(0,0);
				var punkt_zaczepienia = new google.maps.Point(15,12);
				
			var polska = new google.maps.MarkerImage("http://gmapsapi.com/ikony/polska.png", rozmiar, punkt_startowy, punkt_zaczepienia);
			var niemcy = new google.maps.MarkerImage("http://gmapsapi.com/ikony/niemcy.png", rozmiar, punkt_startowy, punkt_zaczepienia);
			var czechy = new google.maps.MarkerImage("http://gmapsapi.com/ikony/czechy.png", rozmiar, punkt_startowy, punkt_zaczepienia);			
		    var marker4 = dodajMarker_icon({position: new google.maps.LatLng(52.375599,19.248047), title: 'Polska', icon: polska},'<strong>Polska</strong></br><strong> Moja ojczyzna</strong></br>');
			var marker5 = dodajMarker_icon({position: new google.maps.LatLng(51.385495,9.942627), title: 'Niemcy', icon: niemcy},'<strong> NIEMCY </strong>');
	        var marker6 = dodajMarker_icon({position: new google.maps.LatLng(49.823809,15.183105), title: 'Czechy', icon: czechy},'<strong> CZECHY </strong>');
			
			
			var marker1 = dodajMarker_cloud(53.439068183003684,14.518346786499023,'<strong>Uniwersytet Szczeciński ( nie polecam) </strong><br /></strong><p id="p01">Wydział Nauk Ekonomicznych i Zarządzania</p><br /><a href="http://www.wneiz.pl">www.wneiz.pl</a>');
			var marker2 = dodajMarker_cloud(53.42235902258507,14.489099979400635,'<strong>Gimnazjum nr 20 :D</strong><br /><a href="http://www.gm20.szczecin.pl">www.gm20.szczecin.pl</a>');
		    var marker3 = dodajMarker_cloud(53.429570208134976,14.537014961242676,'<strong>I Liceum Ogólnokształcące</strong><br />im. Marii Curie Skłodowskiej<br /><a href="http://www.lo1.szczecin.pl">www.lo1.szczecin.pl</a>');
			google.maps.event.trigger(marker4,'click');
		}   
