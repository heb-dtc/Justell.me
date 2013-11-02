$(document).ready( function() {

  var geocoder = new google.maps.Geocoder();

  window.jtm = {
    util : {
      trim : function(data) {
        return data.replace(/^\s\s*/, '');
      },
      ldZ : function(data) {
        return (data < 10) ? '0'+data : data;
      },
      lastWord: function(data) {
        words = data.split(' ');
        return words[words.length-1];
      }
    },
    map : null,
    messages : null,
    markers : new google.maps.MVCArray(),
    format : function(data,kind) {
      var place = '';
      if(kind === 'location') {
        if(!data.length) return '';
        data = data.split(',');
        if(data.length >= 2) {
          place =  ' at '+jtm.util.lastWord(data[data.length-2])+', '+jtm.util.trim(data[data.length-1]);    
        } else {
          place =  ' at '+jtm.util.trim(data[data.length-1]);      
        }
        return place;
      } else if (kind === 'timestamp') {
        var d = new Date(parseInt(data,10));
        return ' ('+jtm.util.ldZ(d.getMonth()+1)+'/'+jtm.util.ldZ(d.getDate())+'/'+d.getFullYear()+')';
      }
    },
    init : function() {
      jtm.messages = messages;
    },
    getLatLng : function(obj) {
      var latlng = obj.coords;
      if(!latlng.length) {
        latlng = '45|0';
      }
      latlng = latlng.split('|');
      return new google.maps.LatLng(parseFloat(latlng[0]),parseFloat(latlng[1]));
    },
    locate : function(cb,error) { 
      if(!navigator.geolocation) {
        cb(null);
      } else {
        navigator.geolocation.getCurrentPosition(cb, error);
      }
    },
    translate : function(msg) {
      return $.map(msg,function(item) {
        var coords = item.coords.split('|');
        return {lat:coords[0],lng:coords[1],data:{
          pseudo:item.pseudo,
          message:item.message,
          location:item.location,
          timestamp:item.timestamp
        }};
      });
    }
  };
    
  if(window.fetch) {
    // Init code is here
    
    var mapStyle = [{
        "featureType": "water",
        "stylers": [
          { "color": "#26242F" },
          { "visibility": "on" }
        ]
      },{
        "featureType": "transit",
        "stylers": [
          { "visibility": "off" }
        ]
      },{
        "featureType": "administrative",
        "elementType": "labels.icon",
        "stylers": [
          { "hue": "#fff700" },
          { "saturation": 100 },
          { "lightness": -89 },
          { "color": "#22aaff" },
          { "weight": 0.1 },
          { "visibility": "off" }
        ]
      },{
        "featureType": "landscape",
        "stylers": [
          { "lightness": 3 },
          { "color": "#ffffac" }
        ]
      }];
    var mapType = google.maps.MapTypeId.TERRAIN;
    
    var makeMap = function(lat,lng) {
      $('#map_canvas').gmap3({
        map:{
          options:{
            center: [lat||45, lng||0],
            zoom: 2,
            mapTypeId: mapType,
            styles: mapStyle
          }
        },marker:{
          values:jtm.translate(window.messages),
          /*cluster:{
            radius:10,
            0:{
              content:'<div class="info-box cluster size_0"></div>'
            },
            20:{
              content:'<div class="info-box cluster size_20"></div>'
            },
            40:{
              content:'<div class="info-box cluster size_40"></div>'
            },
            60:{
              content:'<div class="info-box cluster size_60"></div>'
            },
            80:{
              content:'<div class="info-box cluster size_80"></div>'
            },
            100:{
              content:'<div class="info-box cluster size_100"></div>'
            }
          },
          options: {
            icon: new google.maps.MarkerImage("/img/blank.png"),//new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_green.png")
            visible: true
          },*/
          events:{
            mouseover:function(marker, event, context) {
              $(this).gmap3({
                  clear:"overlay"
                },{
                  overlay:{
                    latLng: marker.getPosition(),
                    options:{
                      visible: true,
                      content: '<div class="info-box message">' + context.data.pseudo + ': ' + context.data.message + '</div>'
                    }
                  }
              });
            },
            mouseout: function(){
              $(this).gmap3({clear:"overlay"});
            }
          }
        }
      });
    };
    
    jtm.locate(function(pos) {
      makeMap(pos.coords.latitude, pos.coords.longitude);
    },function() {
      makeMap(45,0);
    });
  }
  
});