$(document).ready( function() {
  
  var ul = {
    errors: [],
    processErrors: function() {
      $('.error').html('&#10005; '+ul.errors.join(' ,'));
    },
    clean: function($node) {
    
      $msg = $('.success');
    
      if(ul.errors.length != 0) { 
        $msg = $('.error');
        $node[0].reset();
      }
      
      $node.animate({opacity:'0'},250);
      $msg.css({display:'block'});
      $msg.animate({opacity:'1'},250);

      ul.errors = [];
    }
  };
  
  if(window.FormData) {
    $('#submit').hide();
    
    var fd = new FormData();
    
    var $form = $('form'),
        $file = $('input[type="file"]');
    
    $file.on('change', function() {
    
      console.log($file[0].files);
      
      var formdata,file = $file[0].files[0];
      
      if (!!file.type.match(/image.*/) && file.size < 100000) {  
        fd.append("images[]", file); 

        $.ajax({  
            url: "upload",  
            type: "POST",  
            data: fd,  
            processData: false,  
            contentType: false,  
            success: function (res) {
              if(res.errors) {
                ul.errors = ul.errors.concat(res.errors);
              }
              ul.processErrors();
              ul.clean($form);
            }  
        });  
      } 
      if(!file.type.match(/image.*/)) {
        ul.errors.push('wrong file type');
      }
      if(file.size >= 100000) {
        ul.errors.push('file too big');
      }
      ul.processErrors();
      ul.clean($form);
    });
    
  }
  
});