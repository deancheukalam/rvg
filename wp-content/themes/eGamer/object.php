<?php
  function getTitle()
  {
    global $wpdb;
    $v = $_POST[ 'v' ];
    $t='';
    $query = "SELECT wp_posts.post_title
              FROM wp_posts
              LEFT OUTER JOIN wp_postmeta
              ON wp_posts.ID=wp_postmeta.post_id
              WHERE wp_postmeta.meta_value LIKE '".$v."'
              AND wp_posts.post_status='publish'
              AND wp_postmeta.meta_key='Objectnummer'
              ORDER BY wp_posts.post_date
              DESC"; 
    $rows = $wpdb->get_results( $query,ARRAY_N );
    if($rows)
    {
      foreach( $rows as $row ) 
      {  
       $t .= $row[ 0 ];
      } 
    }
    else
    {
     $t.='';
    }
    echo $t;
    die();
   }
?>