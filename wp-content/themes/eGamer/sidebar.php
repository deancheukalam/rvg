<br></br>
<div id="sidebar">
<h1 class="post-title post-title2" style="margin-top: 12px; line-height: 30px; font-size: 18px; font-family: verdana,geneva; font-weight: bold; text-decoration: none;">Zoeken<img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streepklein.gif" border="0">
                </h1>
    <br>
    <?php
    $locArgs = array(
    'type'                     => 'post',
    'child_of'                 => 11,
    'parent'                   => '',
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'hide_empty'               => 1,
    'hierarchical'             => 1,
    'exclude'                  => '',
    'include'                  => '',
    'number'                   => '',
    'taxonomy'                 => 'category',
    'pad_counts'               => false );
    $locations = get_categories( $locArgs ); 
    foreach($locations as $loc){
        $locString .= $loc->term_id.',' ;
    }
    //prijs koopwoningen
    $prijsKoopWoningenArgs = array(
    'type'                     => 'post',
    'child_of'                 => 36,
    'parent'                   => '',
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'hide_empty'               => 1,
    'hierarchical'             => 1,
    'exclude'                  => '',
    'include'                  => '',
    'number'                   => '',
    'taxonomy'                 => 'category',
    'pad_counts'               => false );
    $prijskoopwoningen = get_categories( $prijsKoopWoningenArgs );
    foreach($prijskoopwoningen as $prijskoopwoning){
        $prijskoopwoningString .= $prijskoopwoning->term_id.',' ;
    }
    //prijs huurwoningen
    $prijsHuurWoningenArgs = array(
    'type'                     => 'post',
    'child_of'                 => 43,
    'parent'                   => '',
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'hide_empty'               => 1,
    'hierarchical'             => 1,
    'exclude'                  => '',
    'include'                  => '',
    'number'                   => '',
    'taxonomy'                 => 'category',
    'pad_counts'               => false );
    $prijshuurwoningen = get_categories( $prijsHuurWoningenArgs );
    foreach($prijshuurwoningen as $prijshuurwoning){
        $prijshuurwoningenString .= $prijshuurwoning->term_id.',' ;
    }
    //prijs percelen
    $prijsPercelenArgs = array(
    'type'                     => 'post',
    'child_of'                 => 49,
    'parent'                   => '',
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'hide_empty'               => 1,
    'hierarchical'             => 1,
    'exclude'                  => '',
    'include'                  => '',
    'number'                   => '',
    'taxonomy'                 => 'category',
    'pad_counts'               => false );
    $prijsPercelen = get_categories( $prijsPercelenArgs );
    foreach($prijsPercelen as $prijsPerceel){
        $prijsPerceelString .= $prijsPerceel->term_id.',' ;
    }
    //oppervlakte percelen
    $oppervlaktePercelenArgs = array(
    'type'                     => 'post',
    'child_of'                 => 54,
    'parent'                   => '',
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'hide_empty'               => 1,
    'hierarchical'             => 1,
    'exclude'                  => '',
    'include'                  => '',
    'number'                   => '',
    'taxonomy'                 => 'category',
    'pad_counts'               => false );
    $oppervlaktePercelen = get_categories( $oppervlaktePercelenArgs );
    foreach($oppervlaktePercelen as $oppervlaktePerceel){
        $oppervlaktePerceelString .= $oppervlaktePerceel->term_id.',' ;
    }
    ?>
	<div id="zoeken">
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <input type="text" 
        class="resizedTextbox" 
        value="zoek op straatnaam..."
        onclick="if(this.value=='zoek op straatnaam...'){this.value=''}" 
        name="s" 
        id="s" /><br>
		 </div>
        <div id="zoeken-botton">
	</div>
</form>
<br>
<div id="zoeken">
  <form role="search" method="post" id="searchform" action="<?php echo home_url( '/' ); ?>">
  <input type="text" 
         class="ObjectTextbox resizedTextbox" 
         value="zoek op objectnummer..." 
         name="s" 
         onclick="if(this.value=='zoek op objectnummer...'){this.value=''}"
         id="s" />
  </form> 
</div>
<div id="zoeken-botton">   
</div>
<br />  
<!------------->
	<form action="<?php bloginfo('url'); ?>/" method="get">
	<div id="zoekbox">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
//$select = wp_dropdown_categories('show_option_none=Selecteer een van de opties&show_count=1&orderby=name&echo=0&include=37,38,39,40,41,42');
$select = wp_dropdown_categories('show_option_none=koopwoningen op prijs&show_count=1&orderby=name&echo=0&include='.$prijskoopwoningString);
$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
echo $select;
?>
	<noscript><div><input type="submit" value="View" /></div></noscript>
	</div></form>
	<br>
	<form action="<?php bloginfo('url'); ?>/" method="get">
	<div id="zoekbox">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
//$select = wp_dropdown_categories('show_option_none=Selecteer een van de opties&show_count=1&orderby=name&echo=0&include=50,51,52,53');
$select = wp_dropdown_categories('show_option_none=percelen op prijs&show_count=1&orderby=name&echo=0&include='.$prijsPerceelString);
$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
echo $select;
?>
	<noscript><div><input type="submit" value="View" /></div></noscript>
	</div></form>
	<br>
	<form action="<?php bloginfo('url'); ?>/" method="get">
	<div id="zoekbox">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
//$select = wp_dropdown_categories('show_option_none=Selecteer een van de opties&show_count=1&orderby=name&echo=0&include=55,56,57,58');
$select = wp_dropdown_categories('show_option_none=percelen op oppervlakte&show_count=1&orderby=name&echo=0&include='.$oppervlaktePerceelString);
$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
echo $select;
?>
	<noscript><div><input type="submit" value="View" /></div></noscript>
	</div></form>
<br>    

	<div id="zoekbox">
	<form action="<?php bloginfo('url'); ?>/" method="get">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
//$select = wp_dropdown_categories('show_option_none=Selecteer een van de opties&show_count=1&orderby=name&echo=0&include=12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35');
$select = wp_dropdown_categories('show_option_none=objecten op locatie&show_count=1&orderby=name&echo=0&include='.$locString);
$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
echo $select;
?>
	<noscript><div><input type="submit" value="View" /></div></noscript>
	</div></form>
<br>
<a href="http://www.remyvastgoed.com/maps"><img src="http://www.remyvastgoed.com/wp-content/uploads/map.jpg" style="margin-left:15px" /></a>
<br>    
<h1 class="post-title" style="margin-top: 43px; line-height: 29px; font-size: 18px; font-family: verdana,geneva; font-weight: bold; text-decoration: none;">
                Contact<img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streepklein.gif" border="0">
              </h1>
    <IFRAME SRC="?page_id=5&content-only=1" WIDTH="210" HEIGHT="250" frameborder="0" SCROLLING="no" ALLOWTRANSPARENCY="true">Sorry, je browser ondersteunt geen frames...</IFRAME><br>
    
<h1 class="post-title" style="margin-top: 43px; line-height: 29px; font-size: 18px; font-family: verdana,geneva; font-weight: bold; text-decoration: none;">Suriname<img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streepklein.gif" border="0">
<br/>
<script src="http://www.clocklink.com/embed.js"></script><script type="text/javascript" language="JavaScript">obj=new Object;obj.clockfile="5005-gray.swf";obj.TimeZone="Suriname_Paramaribo";obj.width=180;obj.height=60;obj.wmode="transparent";showClock(obj);</script>
<br>
<div style="font-family: Arial;background-color: transparent;border: 1px solid transparent;width: 210px;height: 170px;-moz-box-shadow: 0 0 2px 1px transparent;-webkit-box-shadow: 0 0 2px 1px transparent;box-shadow: 0 0 2px 1px transparent;overflow: hidden; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;"><div style="width: 160px;height: 200px;margin-left: 25px;"><div style="margin:7px 10px;"><div style="color: #222222;font-family: Arial;font-size: 14px;font-weight: bold;margin: 0px 0px 7px 0px;line-height: 14px;">Weersverwachting<br/><span style="font-weight:normal;">Paramaribo</span></div><iframe id="widget-frame" src="http://www.weeronline.nl/Go/ExternalWidgetsNew/ThreeDaysCity?gid=2437464&sizeType=2&temperatureScale=Celsius&defaultSettings=False" width="140" height="130" frameborder="0" scrolling="no" style="border: none;" allowtransparency="true"></iframe></div></div></div>
<br>
       <!--&nbsp;&nbsp;<a href="http://nl.wikipedia.org/wiki/Suriname" target="_blank"><img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/suriname.png"></a><br>-->
<h1 class="post-title" style="margin-top: 43px; line-height: 29px; font-size: 18px; font-family: verdana,geneva; font-weight: bold; text-decoration: none;">Advertenties<img src="http://www.remyvastgoed.com/wp-content/themes/eGamer/images/streepklein.gif" border="0">
<br>
<div id="banner_ronan">
	<a href="http://www.nvronantrading.com/" target="_blank"><img src="http://www.remyvastgoed.com/wp-content/uploads/ronan187x2002.gif" /></a>
</div>
<br>
<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FRemyVastgoedNV&amp;width=201&amp;height=290&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=true&amp;header=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:201px; height:290px;" allowTransparency="true"></iframe>
<p>&nbsp;</p>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
    <?php endif; ?>
</div>
</div>