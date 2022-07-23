$(function() {

    //INSTANCIA GLOBAL DE MAPA
    
    // var marker = new google.maps.Marker();
    // var location, var_mapoptions, var_map, infoWindow;
    // var_map = new google.maps.Map(document.getElementById("map-container-3"), var_mapoptions);

    
    var location = new google.maps.LatLng(20.65644857, -103.32541019);
    var var_mapoptions = { center: location, zoom: 16, mapTypeId: 'satellite'};
    var var_map = new google.maps.Map(document.getElementById("map-container-3"),var_mapoptions);
    var marker = new google.maps.Marker({ position: location, map: var_map, title: "Guadalajara, Mexico"});;
    var infoWindow;
    
    
    // Satellite map
    function satellite_map() {
    location = new google.maps.LatLng(20.65644857, -103.32541019);
    var_mapoptions = {
    center: location,
    zoom: 18,
    mapTypeId: 'satellite'
    };
    var_map = new google.maps.Map(document.getElementById("map-container-3"), var_mapoptions);
    marker = new google.maps.Marker({
    position: location,
    map: var_map,
    title: "Guadalajara, Mexico"
    });
    }
    
    // Initialize maps
    
        google.maps.event.addDomListener(window, 'load', satellite_map);
    
        //Geolocalitation
    
        infoWindow = new google.maps.InfoWindow;
    
        if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
    
                            };
                            infoWindow.setPosition(pos);
                            infoWindow.setContent('<img src="../img/UbicationM.png">');
                            //infoWindow.setContent('Location found.');
                            infoWindow.open(var_map);
                            var_map.setCenter(pos);
                        }, function() {
                            handleLocationError(true, infoWindow, var_map.getCenter());
                        });
                    } else {
                        // Browser doesn't support Geolocation
                        handleLocationError(false, infoWindow, var_map.getCenter());
                    }
    
    
                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                    infoWindow.setPosition(pos);
                    infoWindow.setContent(browserHasGeolocation ?
                                                                'Error: The Geolocation service failed.' :
                                                                'Error: Your browser doesn\'t support geolocation.');
                    infoWindow.open(var_map);
                }
    
    
    
    
    
    
    
    function newLocation(newLat,newLng)
    {
        var_map.setCenter({
            lat : newLat,
            lng : newLng
        });
      location = {lat: newLat, lng: newLng}
      marker.setPosition(location);
      var_map.setZoom(20);
    }
    
    $('.cambiarmapa').click(function(e) {
        var abstractor = $(this).siblings('input[type="hidden"][class$="coord-map"]').val();
         //= $('#coord-map').val();
        var coordenadas = abstractor.split(',');
        var c1 = parseFloat(coordenadas[0]);
        var c2 = parseFloat(coordenadas[1]);
        newLocation(c1, c2);
       });
    
    });