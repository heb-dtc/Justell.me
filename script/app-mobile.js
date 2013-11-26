$(document).ready( function() {

  var geocoder = new google.maps.Geocoder();

  window.jtm = {
  	//--------------------------------------------//
	//               CLASS VARIABLES 
	//--------------------------------------------//
  	mPlace : '',
  	mName : '',
  	mMsg : '',
  	mCoords : false,
  	//--------------------------------------------//
	//          GET COORDINATES FUNCTION 
	//--------------------------------------------//
    getCoords : function() {
      if(!jtm.mCoords) return '';
      return jtm.mCoords.latitude+'|'+jtm.mCoords.longitude;
    },
  	//--------------------------------------------//
	//            GET PLACE FUNCTION
	//--------------------------------------------//
    getPlace : function(lat,lng) {
      console.log(lat,lng);
      var latlng = new google.maps.LatLng(lat, lng);
      geocoder.geocode({'latLng': latlng}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            jtm.mPlace = results[0].formatted_address;
            console.log(jtm.mPlace);
			
			//if getPlace() was called the rule is to call uploadToDB()
			jtm.uploadToDB();
        } else {
          jtm.mPlace = '';
		  
		  //if getPlace() was called the rule is to call uploadToDB()
		  jtm.uploadToDB();
        }
      });
    },
  	//---------------------------------------------------------//
	//        LOCATE --> get localistion from mobile device
	//---------------------------------------------------------//
    locate : function() { 
      if(!navigator.geolocation) {
        //no geolocalisation available, we just write to DB
        jtm.uploadToDB();
      } else {
        var options = {
          enableHighAccuracy: false,
          timeout: 5000,
          maximumAge: 0
        };
        navigator.geolocation.getCurrentPosition(function(position){
          //success CallBack
          jtm.mCoords = position.coords;
          jtm.getPlace(position.coords.latitude,position.coords.longitude);
        }, function(){
        //failure CallBack
          jtm.uploadToDB();
        }, options);
      }
    },
	//---------------------------------------------------------//
	//        uploadToDB --> push data to DB
	//---------------------------------------------------------//
    uploadToDB : function() {
      var place   = '';
      var coords  = '';	
      
      //if geoloc was posible, get the data
      if(jtm.mCoords) {
        coords = jtm.getCoords();
        place  = jtm.mPlace;
      }
    
      $.post('add.php',{
        pseudo : jtm.mName,
        message : jtm.mMsg,
        location : place,
        coords : coords,
        timestamp:new Date().getTime()
      }, function(data) {
        // Bring the user to /message
        //window.location = "http://justell.me/message";
      });
    }
  };

  //--------------------------------------------//
  //      HANDLER FOR BUTTON CLICK ON MOBILE
  //--------------------------------------------//
  //$('#send').click(function(e) {
  $('#send').click(function(e){

  	$('.slider').show();

  	//read values from HTML
    var pseudo  = $('#pseudo').val().trim();
    var message = $('#text').val().trim();
          
    //if name and msg are here lets move on
    if(pseudo && message) {
      //save the values into members variables for later access
      jtm.mName = pseudo;
      jtm.mMsg = message;
      //start up localisation operations
      jtm.locate();

  	//avoid reload of the page
  	e.preventDefault();
    }
  });
 });