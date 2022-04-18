alert(10);
jQuery(document).ready(function() { alert(0); 
  var GreetingAll = jQuery("#j").val();  
  jQuery("#PleasePushMe").click(function(){ jQuery.ajax({  
    type: 'POST',  
    url: 'http://www.remyvastgoed.com/wp-admin/admin-ajax.php',  
    data: {  
    action: 'getTitle',  
    v: GreetingAll  
    },  
    success: function(data, textStatus, XMLHttpRequest){  
    jQuery("#test-div1").html('');  
    jQuery("#test-div1").append(data);  
    },  
    error: function(MLHttpRequest, textStatus, errorThrown){  
    alert(errorThrown);  
    }  
    });  
    }));  
    });  