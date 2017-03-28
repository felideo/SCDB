<script type="text/javascript">
	jQuery(function($) {
	    // Asynchronously Load the map API
	    var script = document.createElement('script');
	   	script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCJyqaBa2Mz9RfWXxWW9MYnC0UGr9GOH5A&callback=initialize";
	    document.body.appendChild(script);
	});

	  // Multiple Markers
    var markers = [
        ['', -23.406,-46.762],
        ['', -23.447,-46.706]
    ];

    function initialize(new_marks) {
    	if (typeof new_marks !== 'undefined') {
      		console.log(markers);

      		markers.push(new_marks);
      		console.log(markers);
    	}

        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap',
            zoom: 5

        };

        // Display a map on the page
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        map.setTilt(45);



        // Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow(), marker, i;

        // Loop through our array of markers & place each one on the map
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0]
            });

            map.fitBounds(bounds);
        }

        // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(10);
            google.maps.event.removeListener(boundsListener);
        });

    }

    function lat_long_validate (number_lat,number_lng) {
        if (inrange(-90,number_lat,90) && inrange(-180,number_lng,180)) {
            return true;
        }
        else {
        	swal("Erro", "Latitude ou longitude invalida!", "error");
    			$('.validar_email').val('');
            return false;
        }
    }

    $(document).ready(function(){
    	$('.latitude').on('change', function(){
    		if(inrange(-90, $('.latitude').val(), 90)){
    	        return true;
    	    }else{
    	    	swal("Erro", "Latitude inválida!", "error");
    			$('.latitude').val('');
    	        return false;
    	    }
    	});

    	$('.longitude').on('change', function(){
    		if(inrange(-180, $('.longitude').val(), 180)){
    	        return true;
    	    }else{
    	    	swal("Erro", "Longitude invalida!", "error");
    			$('.longitude').val('');
    	        return false;
    	    }
    	});

    	$('#add_localizacao').on('click', function(){
            if($('.latitude').val() == '' && $('.longitude').val() == ''){
                return false;
            }

    		if(lat_long_validate($('.latitude').val(), $('.longitude').val())){
    			initialize(['', $('.latitude').val(), $('.longitude').val()]);

                input = '<div>\n\t\t'
                    + '<input type="hidden" value="' + $('.latitude').val() + '" name="posicao_geografica[' + $("#posicao_geografica_inputs > div").length + '][latitude]" />\n\t\t'
                    + '<input type="hidden" value="' + $('.longitude').val() + '" name="posicao_geografica[' + $("#posicao_geografica_inputs > div").length + '][longitude]" />\n\t\t'
                    + '</div>\n';

                    console.log(input);

                $('#posicao_geografica_inputs').append(input);

    			$('.latitude').val('');
    			$('.longitude').val('');

    		}
    	});
    });

    function inrange(min, number, max){
        if ( !isNaN(number) && (number >= min) && (number <= max) ){
            return true;
        } else {
            return false;
        };
    }
</script>
