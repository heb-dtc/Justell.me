$(document).ready( function() {

  window.jtm = {
    //--------------------------------------------//
	//                   UTILS 
	//--------------------------------------------//
    util : {
      trim : function(data) {
        return data.replace(/^\s\s*/, '');
      }
    },
	//--------------------------------------------//
	//               CLASS VARIABLES 
	//--------------------------------------------//
  mPlace : '',
	mMsg : '',
	mName : '',
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
	//--------------------------------------------//
	//        FORMAT LOCATION OR TIMESTAMP
	//--------------------------------------------//
    format : function(data,kind) {
      var place = '';
      if(kind === 'location') {
        if(!data.length) return '';
        data = data.split(',');
        return jtm.util.trim(data[data.length-1]);
      } else if (kind === 'timestamp') {
        var d = new Date(parseInt(data,10));
        return ' ('+d.toLocaleDateString()+')';
      }
    },
	//-----------------------------------------------------------------------//
	//    FETCH --> FETCH MSG FROM DB IF LIMIT IS 0 or NULL, LIMIT IS 100. 
	//-----------------------------------------------------------------------//
    fetch : function(limit,message) {
      limit=limit||1000;
      $.get('fetch.php?limit='+limit,function(data) {
        jtm.update(data,message);
      });
    },
	//----------------------------------------------------------------//
	//         UPDATE --> DISPLAY MSG ON MOBILE DEVICE OR COMPUTER
	//----------------------------------------------------------------//
    update : function(obj,msg) {
      var p_X = -1;
      var text='',i=0,l=obj.length;
      var mob = msg ? ' ta_mob' : 'textarea';

      for(i=0;i<l;i++) {
        var x = Math.floor((Math.random()*55)+1);
      
        while( (p_X == x) ) {
          x = Math.floor((Math.random()*4)+1);
        }
        p_X = x;
        var couleur = 'textbox With_Font_Box Color_'+x;
        
        var location = this.format(obj[i].location,'location');
        if(location.length == 0) {
          location = "Wonderland";
        }
        var message = obj[i].message.toUpperCase() + " - " + obj[i].pseudo + " in " + location + " ";
        
      //timestamps are not displayed on mobile
      if(!msg) {
          message += this.format(obj[i].timestamp,'timestamp') + " ";
        }
        text += '<span class="' + couleur + '">' + message + '</span>';
      }
      
      $('.content').prepend(text);
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
        pseudo  :jtm.mName,
        message :jtm.mMsg,
        location:place,
        coords  :coords,
        timestamp:new Date().getTime()
      }, function(data) {
        // Bring the user to /message
        window.location = "http://justell.me/message";
      });
    }
  };

  //--------------------------------------------//
  //      HANDLER FOR BUTTON CLICK ON MOBILE
  //--------------------------------------------//
  $('#send').click(function(e) {
    //read values from HTML
    var pseudo  = $('#pseudo').val().trim();
                  $('#pseudo').val('');
    var message = $('#text').val().trim();
                  $('#text').val('');
    //if name and msg are here lets move on
    if(pseudo && message) {
      //save the values into members variables for later access
      jtm.mName = pseudo;
      jtm.mMsg = message;
      //start up localisation operations
      jtm.locate();
    }
  });
  
  if(window.fetch) {
    jtm.fetch();
  }
  
});
