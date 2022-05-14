<?php global $egamer_catnum_posts, $egamer_grab_image; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>><head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Remy Vastgoed | Onroerend goed in Suriname</title>
<?php elegant_description(); ?> 
<?php elegant_keywords(); ?> 
<?php elegant_canonical(); ?>

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="http://www.remyvastgoed.com/wp-content/themes/eGamer/js/jquery.fancybox.css?v=2.1.2" media="screen" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <script>
    $(function() {
        $( "#datepicker" ).datepicker();
    });
    </script>
    
    <script type="text/javascript" src="http://www.remyvastgoed.com/wp-content/themes/eGamer/js/jquery.fancybox.js?v=2.1.3"></script>

<script type="text/javascript">alert(3);
    //jQuery(document).ready(function() {  
    var OB = jQuery(".ObjectTextbox").val();  
    jQuery(".ObjectTextbox").click(function(){ 
     jQuery.ajax({  
     type: 'POST',  
     url: 'http://www.remyvastgoed.com/wp-admin/admin-ajax.php',  
     data: {  
            action: 'MyAjaxFunction',  
            GreetingAll: OB 
     },  
      success: function(data, textStatus, XMLHttpRequest){  
      //jQuery("#test-div1").html('');  
      //jQuery("#test-div1").append(data); 
      jQuery(".ObjectTextbox").val() = data; 
     },  
     error: function(MLHttpRequest, textStatus, errorThrown){  
     alert(errorThrown);  
     }  
  });  
  }));  
  //});  
</script>
    
<script type="text/javascript">
  jQuery(document).ready(function($){

    //hide all inputs except the first one
    $('p.hide').not(':eq(0)').hide();

    //functionality for add-file link
    $('a.add_file').on('click', function(e){
      //show by click the first one from hidden inputs
      $('p.hide:not(:visible):first').show('slow');
      e.preventDefault();
    });

    //functionality for del-file link
    $('a.del_file').on('click', function(e){
      //var init
      var input_parent = $(this).parent();
      var input_wrap = input_parent.find('span');
      //reset field value
      input_wrap.html(input_wrap.html());
      //hide by click
      input_parent.hide('slow');
      e.preventDefault();
    });
  });
</script>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if IE 7]>	
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/iestyle.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/ie6style.css" />
<script defer type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/pngfix.js"></script>
<![endif]-->
<!--[if lte IE 9]>	
<style type="text/css">
div.input select {
    width: 272px!important;
}

div.input textarea {
    width: 269px!important;
}

input.input-mid {
    width: 215px!important;
}
</style>
<![endif]-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<style type="text/css">

#pages, #categories {
    font-family: Verdana;
    font-size: 11px;

}
#pages ul li a:link, #pages ul li a:visited, #pages ul li a:active,
#categories ul li a:link, #categories ul li a:visited, #categories ul li a:active{
 padding: 0 0;

}

#pages ul{
    padding: 0;
    margin-left:70px;
	width:auto;
}
#categories ul{
    padding: 0;
    margin-left:20px;


}

#pages li.home, #categories li.home {
    margin-right: -100px!important;
}

#pages ul li a ,
#categories ul li a{
	width: 190px !important;
	font-size: 13px !important;
	display:block;
}

#pages ul li a.smaller ,
#categories ul li a.smaller{
	width: 150px !important;
}

#categories ul li a:link, #categories ul li a:visited, #categories ul li a:active {
	margin: 0;	
}

.home-post-wrap {
    margin-bottom: 20px;
}

#left-div h1 {
    text-align: left;

}

.wpcf7-form {
    font-family: Verdana;

}

</style>

</head>
<?php 
  $url = $_SERVER['REQUEST_URI'];
  if (strpos($url, "informatie-aanvragen")!==false){ 
?>
<body class="info_aanvragen">

<input id="hidden" class="hidden" type="hidden" />
<script type="text/javascript">
	$(document).ready(function() {
			//alert("the url of the top is" + top.location.href );

			var elem = document.getElementById("hidden");
			elem.value = top.location.href;
					
			var val = $("input.hidden").val();
			var myString = val.substr(val.indexOf("archives/") + 9);
			
			$('#onderwerp').val($('#onderwerp').val() + myString);
	});
</script>
<style type="text/css">
	single-entry-titles, #container, #left-div, #wrapper, .post-wrapper, .single-entry-titles {
	width: auto!important;	
}

#left-div {
	width: auto;
	float: left;
	padding-left: 0px;
}

h1 {
margin-top:55px!important;	
}

h1 img {
display:none;	
}
</style>
<?php
}else{
?>
<body class="<?php if(strpos($url, "marketingdienst_verhuur")!==false){ echo 'marketingdienst_verhuur'; } ?>">
<?php } ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="wrapper2">
<?php if (get_option('egamer_468_enable') == 'on') { ?>
<?php include(TEMPLATEPATH . '/includes/468x60.php'); ?>
<?php } else { echo ''; } ?>
<div id="wrapper">
<!--This controls pages navigation bar-->	
		
<div id="pages">
<table width="1000px">
    <tr >
        <td>
            <ul>
                <li class="home"><a href="http://www.remyvastgoed.com">HOME</a></li>
                <li><a href="http://www.remyvastgoed.com/?cat=5" class="smaller">koopwoningen</a></li>                
                <li style="width: 148px;"><a href="http://www.remyvastgoed.com/?page_id=632">percelen</a></li>
                <li style="width: 192px;"><a href="http://www.remyvastgoed.com/?page_id=8">verkavelingsprojecten</a></li>                
				<li><a href="http://www.remyvastgoed.com/financiering" class="smaller">financieringen</a></li>                
             	<li><a href="http://www.remyvastgoed.com/bemiddeling" class="smaller">bemiddeling</a></li>
            </ul>
        </td>
            
       

            
      
        
    </tr>
</table>
</div>

<!--End pages navigation-->
<!--This controls the categories navigation bar-->
<div id="categories">
    <table width="990px">
        <tr >
            <td>
                <ul>
                    <li style="width: 91px;"><a href="http://www.remyvastgoed.com/?page_id=646">bouw</a></li>
                    <li style="width: 149px;"><a href="http://www.remyvastgoed.com/?cat=6">huurwoningen</a></li>
                    <li><a href="http://www.remyvastgoed.com/?page_id=617" class="smaller">studentenkamers</a></li>
                    <li><a href="http://www.remyvastgoed.com/?page_id=630">vakantieaccomodaties</a></li>
                    <li style="width: 150px;"><a href="http://www.remyvastgoed.com/?cat=7">commercieel o.g.</a></li>
                    <li><a href="http://www.remyvastgoed.com/?page_id=10" class="smaller">overige diensten</a></li>
                </ul>
            </td>
  
        </tr>

</table>

</div>


<!--End category navigation-->