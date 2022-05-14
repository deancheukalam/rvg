<?php

	#INSERT INTO wp_postmeta (post_id, meta_key, meta_value) SELECT post_id, "_thumbnail_id" as meta_key, "00000" as meta_value FROM wp_postmeta WHERE meta_key = "Thumbnail" AND post_id NOT IN(SELECT post_id FROM wp_postmeta WHERE meta_key = "_thumbnail_id"


	ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
	$servername = 'db.remyvastgoed.com';
	$username 	= 'md181479db344442';
	$password 	= 'hdAabwUA';
	$dbname 	= 'md181479db344442';
	$websiteurl = 'http://localhost/allojeffrey/';
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$postmetadata 	= array();
	$postdata 		= array();

	$sql = "SELECT p.*, x.meta_key AS k, x.meta_value AS img, y.guid, y.ID AS aidfoeapost 
			FROM wp_postmeta AS p 
			LEFT JOIN wp_postmeta AS x ON p.post_id = x.post_id
			LEFT JOIN wp_posts AS y ON x.meta_value = y.guid
			WHERE p.meta_value = '00000' AND x.meta_key = 'Thumbnail' AND x.meta_value != ''";

    $res = $conn->query($sql);
    if ($res->num_rows > 0) {    
        while($row = $res->fetch_assoc()) {
            $postmetadata[]    = $row;
        }
    }


    foreach($postmetadata as $key => $d){
    	$q = 'UPDATE wp_postmeta SET meta_value = '.$d['aidfoeapost'].' WHERE post_id = '.$d['post_id'].' AND meta_key="_thumbnail_id"';
    	echo $q . ';<br />';

    	if($key % 100 == 0){
    		// echo '<br />------------------------------<br /><br />';
    	}
    }



?>