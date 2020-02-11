
   <style>
      #map {
       height: 400px;
       width: 100%;
      }
   </style>
   <br>
   <div id="map"></div>
   <script>

   var $ = jQuery;

     function initMap() {
       var container = $('#dealers'),
       box = container.find('.tailor-box');
       var locations = [];
       box.each(function() {
         var title = $(this).find('h3').text();
         var address_line = $(this).find('small + p').text();
         var address = $(this).find('.lat-long').text();
         var address = address.split(',');
         var lat = address[0];
         var lng = address[1];
        // console.log(lat);
        // console.log(lng);
         var market = $(this).find('input[type=hidden]').val();
         var phone = $(this).find('.phone').text();
         locations.push([title, lat, lng, market, phone, address_line]);
       });

      console.log(locations);



  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 3,
    center: new google.maps.LatLng(41.959490, -53.613281),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var infowindow = new google.maps.InfoWindow();

  var marker, i;
  var markers = new Array();

  if($(window).width() < 767) {
  map.setCenter(new google.maps.LatLng(39.563353, -90.703125));
  } else {
  map.setCenter(new google.maps.LatLng(41.959490, -60.613281));
 }
  google.maps.event.addDomListener(window, 'resize', function() {
    if($(window).width() < 767) {
    map.setCenter(new google.maps.LatLng(39.563353, -90.703125));
    } else {
    map.setCenter(new google.maps.LatLng(41.959490, -60.613281));
  }
  });

  for (i = 0; i < locations.length; i++) {
  if(locations[i][3] == 'attach') {
      var custom_icon = {
          url: '/wp-content/themes/builtrite/assets/img/marker-red.png', // url
          scaledSize: new google.maps.Size(30, 30), // scaled size
        }
    } else if(locations[i][3] == 'truck') {
      var custom_icon = {
          url: '/wp-content/themes/builtrite/assets/img/marker-blue.png', // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
            }
      } else {
        var custom_icon = {
        url: '/wp-content/themes/builtrite/assets/img/marker-purple.png', // url
        scaledSize: new google.maps.Size(30, 30), // scaled size
        }
      }
      marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map,
      icon: custom_icon
    });

    markers.push(marker);

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent('<strong>'+locations[i][0]+'</strong><br>'+locations[i][5]+'<br>Call: <a style="color:#ffbb00;font-weight:bold" href="tel:'+locations[i][4]+'">'+locations[i][4]+'</a>');
        infowindow.open(map, marker);
      }
    })(marker, i));
  }

  function AutoCenter() {
    //  Create a new viewpoint bound
    var bounds = new google.maps.LatLngBounds();
    //  Go through each...
    $.each(markers, function (index, marker) {
    bounds.extend(marker.position);
    });
    //  Fit these bounds to the map
  //  map.fitBounds(bounds);
  }
  AutoCenter();
}
</script>

   <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-T70w8-n43haIp_a9u8DSLBXk-tg5cr8&callback=initMap"></script>

<div class="legend">
<img src="<?php echo get_stylesheet_directory_uri().'/assets/img/truck-mount.png'; ?>"/>
<img src="<?php echo get_stylesheet_directory_uri().'/assets/img/attach-stationary.png'; ?>"/>
<img src="<?php echo get_stylesheet_directory_uri().'/assets/img/both.png'; ?>"/>
</div>
