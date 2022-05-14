<?php

if(isset($_GET["objnr"])) {
  $objnr = $_GET["objnr"];
}

mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("root") or die(mysql_error());
$query = ("SELECT * FROM wp_posts WHERE id = '". $objnr ."'");
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_assoc($result);

$query_thumb = ("SELECT * FROM wp_postmeta WHERE post_id = '". $objnr ."' AND meta_key = 'Thumbnail'");
$result_thumb = mysql_query($query_thumb) or die(mysql_error());
$row_thumb = mysql_fetch_assoc($result_thumb);

$query_loc = ("SELECT * FROM wp_postmeta WHERE post_id = '". $objnr ."' AND meta_key = 'Locatie'");
$result_loc = mysql_query($query_loc) or die(mysql_error());
$row_loc = mysql_fetch_assoc($result_loc);

$query_price = ("SELECT * FROM wp_postmeta WHERE post_id = '". $objnr ."' AND meta_key = 'Prijs'");
$result_price = mysql_query($query_price) or die(mysql_error());
$row_price = mysql_fetch_assoc($result_price);

$query_objectnummer = ("SELECT * FROM wp_postmeta WHERE post_id = '". $objnr ."' AND meta_key = 'Objectnummer'");
$result_objectnummer = mysql_query($query_objectnummer) or die(mysql_error());
$row_objectnummer = mysql_fetch_assoc($result_objectnummer);

$query_type = ("SELECT * FROM wp_postmeta WHERE post_id = '". $objnr ."' AND meta_key = 'Type'");
$result_type = mysql_query($query_type) or die(mysql_error());
$row_type = mysql_fetch_assoc($result_type);

$query_titel = ("SELECT * FROM wp_postmeta WHERE post_id = '". $objnr ."' AND meta_key = 'Titel'");
$result_titel = mysql_query($query_titel) or die(mysql_error());
$row_titel = mysql_fetch_assoc($result_titel);

$query_percopp = ("SELECT * FROM wp_postmeta WHERE post_id = '". $objnr ."' AND meta_key = 'Perceel'");
$result_percopp = mysql_query($query_percopp) or die(mysql_error());
$row_percopp = mysql_fetch_assoc($result_percopp);

$query_opp = ("SELECT * FROM wp_postmeta WHERE post_id = '". $objnr ."' AND meta_key = 'Oppervlakte'");
$result_opp = mysql_query($query_opp) or die(mysql_error());
$row_opp = mysql_fetch_assoc($result_opp);

$query_rooms = ("SELECT * FROM wp_postmeta WHERE post_id = '". $objnr ."' AND meta_key = 'Kamers'");
$result_rooms = mysql_query($query_rooms) or die(mysql_error());
$row_rooms = mysql_fetch_assoc($result_rooms);


//echo $row_thumb['meta_value'];
//echo '<pre>';
//var_dump($row);
//echo '</pre>';

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" media="all" href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="css/print.css" rel="stylesheet">     
  </head>
  <body>
    <script>window.print();</script>
    
    <div id="header">
<!--
      <div id="logo">
        <img src="../images/logo_sub.png" />
      </div>
-->
    </div>
    <div id="content">  
          
      <div id="image">
        <img src="<?php echo $row_thumb['meta_value']; ?>" />
      </div>
      
      <div id="kenmerken">
        <div class="kenm_left">
          <div class="title">
            <p><?php echo $row['post_title']; ?></p>
          </div>
          <div class="location">
            <p><?php echo $row_loc['meta_value']; ?></p>
          </div>
        </div>
        <div class="kenm_right">
          <div class="price">
<!--
            <?php
            //if($row_pricemax['meta_value'] != ''){
            ?>
            <p>&euro;<?php //echo $row_price['meta_value'] . ' - &euro;' . $row_pricemax['meta_value']; ?></p>
            <?php
            //}else{
            ?>
-->
            <p>&euro; <?php echo number_format($row_price['meta_value'],0,",","."); ?></p>
<!--
            <?php
            //}
            ?>
-->
          </div>
          <div class="objectnummer">
            <p>#<?php echo $row_objectnummer['meta_value']; ?></p>
          </div>
        </div>
      </div> 
      
      <div id="desc">
        <div class="kenmerken">
          <h2 style="margin-bottom: 10px;!important">Kenmerken</h2>
          <table class="table">
            <?php if(!empty($row_type['meta_value'])){ ?>
            <tr>
              <td>Type</td>
              <td><?php echo $row_type['meta_value']; ?></td>
            </tr>
            <?php } else {} ?>
            <?php if(!empty($row_titel['meta_value'])){ ?>
            <tr>
              <td>Titel</td>
              <td><?php echo $row_titel['meta_value'];?></td>
            </tr>
            <?php } else {} ?>
            <?php if(!empty($row_percopp['meta_value'])){ ?>
            <tr>
              <td>Perceeloppervlakte</td>
              <td><?php echo number_format($row_percopp['meta_value'],0,",","."); ?> m<sup>2</sup></td>
            </tr>
            <?php } else {} ?>
            <?php if(!empty($row_opp['meta_value'])){ ?>
            <tr>
              <td>Oppervlakte</td>
              <td><?php echo number_format($row_opp['meta_value'],0,",","."); ?> m<sup>2</sup></td>
            </tr>
            <?php } else {} ?>
            <?php if(!empty($row_rooms['meta_value'])){ ?>
            <tr>
              <td>Kamers</td>
              <td><?php echo $row_rooms['meta_value']; ?></td>
            </tr>
            <?php } else {} ?>
          </table>
        </div>
        <div class="omschrijving">
          <h2 style="margin-bottom: 10px;!important">Omschrijving</h2> 
          <?php $content = preg_replace( "/\r|\n/", "", $row['post_content']); ?>
          <p><?php echo str_replace("<u></u>","<br>",$content); ?></p>          
        </div>
      </div>
    </div> 
    <script src="js/jquery.min.js"></script>
    <script>
      var replaced = $("body").html().replace(/\[.*\]/g,'');
      $("body").html(replaced);
    </script>
  </body>
</html>