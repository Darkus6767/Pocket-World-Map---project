var mapa; 	// obiekt globalny
			var dymek; 	// okno z informacjami
			var markery=[];
						
			function mapaStart()  
			{  
				var wspolrzedne = new google.maps.LatLng(53.41935400090768, 14.58160400390625);
				var opcjeMapy = {
					zoom: 10,
					center: wspolrzedne,
					mapTypeId: google.maps.MapTypeId.SATELLITE,
					disableDefaultUI: true
				};
				mapa = new google.maps.Map(document.getElementById("mapka"), opcjeMapy); 			
				dymek = new google.maps.InfoWindow();
				
				dodajMarker('Białogard',new google.maps.LatLng(54.00454043850362, 15.9576416015625));
				dodajMarker('Chociwel',new google.maps.LatLng(53.462708023859555, 15.3314208984375));
				dodajMarker('Choszczno',new google.maps.LatLng(53.17064968295498, 15.41107177734375));
				dodajMarker('Drawsko Pomorskie',new google.maps.LatLng(53.528064301939835, 15.805206298828125));
				dodajMarker('Goleniów',new google.maps.LatLng(53.56886083585376, 14.8095703125));
				dodajMarker('Gryfice',new google.maps.LatLng(53.914045676705264, 15.187225341796875));
				dodajMarker('Gryfino',new google.maps.LatLng(53.253712042468464, 14.489593505859375));
				dodajMarker('Kalisz Pomorski',new google.maps.LatLng(53.29477244628862, 15.901336669921875));
				dodajMarker('Kamień Pomorski',new google.maps.LatLng(53.95042878674246, 14.80133056640625));
				dodajMarker('Kołobrzeg',new google.maps.LatLng(54.1801192265262, 15.567626953125));
				dodajMarker('Łobez',new google.maps.LatLng(53.63975308945901, 15.623931884765625));
				dodajMarker('Myślibórz',new google.maps.LatLng(52.92794668795821, 14.863128662109375));
				dodajMarker('Nowe Warpno',new google.maps.LatLng(53.70483639004964, 14.349517822265625));
				dodajMarker('Nowogard',new google.maps.LatLng(53.669866612978275, 15.121307373046875));
				dodajMarker('Police',new google.maps.LatLng(53.55336278552809, 14.574737548828125));
				dodajMarker('Pyrzyce',new google.maps.LatLng(53.140180585580396, 14.88922119140625));
				dodajMarker('Stargard Szczeciński',new google.maps.LatLng(53.33087298301704, 15.044403076171875));
				dodajMarker('Świnoujście',new google.maps.LatLng(53.90595623303201, 14.24652099609375));
				dodajMarker('Szczecin',new google.maps.LatLng(53.41771713379898, 14.536285400390625));
				dodajMarker('Węgorzyno',new google.maps.LatLng(53.533778184257805, 15.54290771484375));
				dodajMarker('Wolin',new google.maps.LatLng(53.84685581614309, 14.604949951171875));
				odswiezPasekBoczny();
			}  
			
			function dodajMarker(nazwa,wspolrzedne)
			{
				var opcje_markera = 
				{
					position: wspolrzedne,
					title: nazwa,
					map: mapa
				};
				var marker = new google.maps.Marker(opcje_markera);
				marker.txt = nazwa;
				
				google.maps.event.addListener(marker,'click',function()
				{
					marker.usun();
				});
				
				markery.push(marker);
			}
			
			function otworzMarker(id)
			{
				if(markery.length-1<id)
					return;
				dymek.open(markery[id].getMap(), markery[id]);
				dymek.setContent(markery[id].txt);
			}
			
			google.maps.Marker.prototype.usun = function()
			{
				if(confirm('Czy na pewno usunąć ten marker?'))
				{
					var tab = [];
					for(var i=0; i<markery.length; i++)
					{
						if(markery[i]!=this)
							tab.push(markery[i]);
					}
					markery=tab;
					this.setMap(null);
					odswiezPasekBoczny();
				}
			}
			
			function odswiezPasekBoczny()
			{
				var html='';
				for(var i=0; i<markery.length;i++)
				{
				
					html+='<li><a href="#" onclick="otworzMarker('+i+'); return false;">'+markery[i].txt+'</a></li>';
				}
				document.getElementById('pasekBoczny').innerHTML = html;
			}
			
		-->
		</script>   