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
  	//         UPDATE --> DISPLAY MSG ON COMPUTER
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
    }
  };
  
  if(window.fetch) {
    jtm.fetch();
  }
  
});
