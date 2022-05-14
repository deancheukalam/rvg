<?php get_header(); ?>

<div id="content">
  <div class="col-md-9 objects">
    
	

	
	
	
	<?php if(is_category('Alle percelen')){ ?>
    <h2>Alle percelen</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_percelen' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>



    <?php }elseif(is_category('Gated community percelen')){ ?>
    <h2>Gated community percelen</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_gatedcommunitypercelen' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>



    <?php }elseif(is_category('Gated community woningen')){ ?>
    <h2>Gated community woningen</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_gatedcommunitywoningen' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>



    <?php }elseif(is_category('Beleggingspanden')){ ?>
    <h2>Beleggingspanden</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_beleggingspanden' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>


    <?php }elseif(is_category('Verkavelingsprojecten')){ ?>
    <h2>Verkavelingsprojecten</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_verkavelingsproj' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>

    

    <?php }elseif(is_category('Studentenkamers')){ ?>
    <h2>Studentenkamers</h2>
	
	<?php }elseif(is_category('Geplaatst op sociale media')){ ?>
    <h2>Geplaatst op sociale media</h2>
	
	<?php }elseif(is_category('Gepromoot op sociale media')){ ?>
    <h2>Gepromoot op sociale media</h2>
	
	<?php }elseif(is_category('Plaatsen op sociale media')){ ?>
    <h2>Plaatsen op sociale media</h2>
	
	<?php }elseif(is_category('Promoten op sociale media')){ ?>
    <h2>Promoten op sociale media</h2>

    <?php }elseif(is_category('Commercieel onroerend goed')){ ?>
    <h2>Commercieel onroerend goed</h2>

    <?php }elseif(is_category('Commercieel percelen')){ ?>
    <h2>Commercieel percelen</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_commercieelperc' ); ?>
    </div>        
    <?php echo do_shortcode('[search-form-results]'); ?>

    <?php }elseif(is_category('Zakelijke kooppanden')){ ?>
    <h2>Zakelijke kooppanden</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_commercieelkoopp' ); ?>
    </div>        
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	<?php }elseif(is_category('Nog af te bouwen woningen')){ ?>
    <h2>Nog af te bouwen woningen</h2>
 
	
	
	<?php }elseif(is_category('Nieuwbouwwoningen')){ ?>
    <h2>Nieuwbouwwoningen</h2>

	
	<?php }elseif(is_category('Alle koopwoningen')){ ?>
    <h2>Alle koopwoningen</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'filter_koop' ); ?>
    </div>        
    <?php echo do_shortcode('[search-form-results]'); ?>
	

    <?php }elseif(is_category('Zakelijke huurpanden')){ ?>
    <h2>Zakelijke huurpanden</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_commercieelhuurp' ); ?>
    </div>        
    <?php echo do_shortcode('[search-form-results]'); ?>
	  
	  <?php }elseif(is_category('Interne financiering mogelijk')){ ?>
    <h2>Interne financiering mogelijk</h2>
	    
	  <?php }elseif(is_category('In prijs verlaagd')){ ?>
    <h2>In prijs verlaagd</h2>
	    
	  <?php }elseif(is_category('Tijdelijk niet beschikbaar')){ ?>
    <h2>Tijdelijk niet beschikbaar</h2>
	
	<?php }elseif(is_category('PerceelsID toegekend')){ ?>
    <h2>PerceelsID toegekend</h2>
	
	<?php }elseif(is_category('PerceelsID aangevraagd')){ ?>
    <h2>PerceelsID aangevraagd</h2>
	
	<?php }elseif(is_category('Stichtingovername mogelijk')){ ?>
    <h2>Stichtingovername mogelijk</h2>
	
	<?php }elseif(is_category('Advertentieobjecten')){ ?>
    <h2>Advertentieobjecten</h2>
	
	<?php }elseif(is_category('Onderpanden')){ ?>
    <h2>Onderpanden</h2>
	
	

	
	
	  <?php }elseif(is_category('Ajay Jilamsing')){ ?>
    <h2>Ajay Jilamsing</h2>
	
	
	<?php }elseif(is_category('Joel Terzol')){ ?>
    <h2>Joel Terzol</h2>

    <?php }elseif(is_category('Greg Sitaram')){ ?>
    <h2>Greg Sitaram</h2>

    <?php }elseif(is_category('Prenobe Bissessur')){ ?>
    <h2>Prenobe Bissessur</h2>

    <?php }elseif(is_category('Stephen Deul')){ ?>
    <h2>Stephen Deul</h2>
	
	<?php }elseif(is_category('Manav Kanhai')){ ?>
    <h2>Manav Kanhai</h2>
	
	<?php }elseif(is_category('Rachella Kowlesar')){ ?>
    <h2>Rachella Kowlesar</h2>
	
	<?php }elseif(is_category('Koos Schols')){ ?>
    <h2>Koos Schols</h2>
	
	<?php }elseif(is_category('Michel Norbruis')){ ?>
    <h2>Michel Norbruis</h2>

	
	  <?php }elseif(is_category('Ajay Sewpal')){ ?>
    <h2>Ajay Sewpal</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Amar Bhagwandas')){ ?>
    <h2>Amar Bhagwandas</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Anand Baidjoe')){ ?>
    <h2>Anand Baidjoe</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Arny de Bruijn')){ ?>
    <h2>Arny de Bruijn</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Ashok Harpal')){ ?>
    <h2>Ashok Harpal</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Baal Bhageloe')){ ?>
    <h2>Baal Bhageloe</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Bharat Gangadin')){ ?>
    <h2>Bharat Gangadin</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Clife Hiwat')){ ?>
    <h2>Clife Hiwat</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Compa')){ ?>
    <h2>Compa</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Daniëlla Thijssen')){ ?>
    <h2>Daniëlla Thijssen</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Dennis Yvel')){ ?>
    <h2>Dennis Yvel</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Dinesh Nannan')){ ?>
    <h2>Dinesh Nannan</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Erik van Pamelen')){ ?>
    <h2>Erik van Pamelen</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Faid Madjoe')){ ?>
    <h2>Faid Madjoe</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Farish Salamat')){ ?>
    <h2>Farish Salamat</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Faroek Alibux')){ ?>
    <h2>Faroek Alibux</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Fazilah Lalmahomed')){ ?>
    <h2>Fazilah Lalmahomed</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Feisal Ghafoerkhan')){ ?>
    <h2>Feisal Ghafoerkhan</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Ferdy Purperhart')){ ?>
    <h2>Ferdy Purperhart</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Frans Harnandan')){ ?>
    <h2>Frans Harnandan</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Gaitri Phagoe')){ ?>
    <h2>Gaitri Phagoe</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Hans Chitoe')){ ?>
    <h2>Hans Chitoe</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Hunfrey Pawiro')){ ?>
    <h2>Hunfrey Pawiro</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Intervast')){ ?>
    <h2>Intervast</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Jerry Oehlers')){ ?>
    <h2>Jerry Oehlers</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('John Noble')){ ?>
    <h2>John Noble</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('K. Tikai')){ ?>
    <h2>K. Tikai</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Karina Kahn')){ ?>
    <h2>Karina Kahn</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Kok Tollens')){ ?>
    <h2>Kok Tollens</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Kries Kalipdewsing')){ ?>
    <h2>Kries Kalipdewsing</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Miquel Spier')){ ?>
    <h2>Miquel Spier</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Navin Tikaram')){ ?>
    <h2>Navin Tikaram</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Nazir')){ ?>
    <h2>Nazir</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Omar Ghafoerkhan')){ ?>
    <h2>Omar Ghafoerkhan</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Paul Wieman')){ ?>
    <h2>Paul Wieman</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Piet Badal')){ ?>
    <h2>Piet Badal</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Rahiet Kali')){ ?>
    <h2>Rahiet Kali</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Rakesh Goerdin')){ ?>
    <h2>Rakesh Goerdin</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Ram Fatingan')){ ?>
    <h2>Ram Fatingan</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Ramon Razabsek')){ ?>
    <h2>Ramon Razabsek</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Remy van der Hoek')){ ?>
    <h2>Remy van der Hoek</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Remy Vastgoed')){ ?>
    <h2>Remy Vastgoed</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Rick Leendertse')){ ?>
    <h2>Rick Leendertse</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Rudy Ardjoen')){ ?>
    <h2>Rudy Ardjoen</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Sabrina Sewnarain')){ ?>
    <h2>Sabrina Sewnarain</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Sameer Natthoe')){ ?>
    <h2>Sameer Natthoe</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Sarwan Gopal')){ ?>
    <h2>Sarwan Gopal</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Shaike Chitoe')){ ?>
    <h2>Shaike Chitoe</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Shawn Bisambhar')){ ?>
    <h2>Shawn Bisambhar</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Stange Soerjbali')){ ?>
    <h2>Stange Soerjbali</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Steven Burgzorg')){ ?>
    <h2>Steven Burgzorg</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Subhas Jhauw')){ ?>
    <h2>Subhas Jhauw</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Sudhir Ramautar')){ ?>
    <h2>Sudhir Ramautar</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Teddy Nannanpanday')){ ?>
    <h2>Teddy Nannanpanday</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Theo Mobach')){ ?>
    <h2>Theo Mobach</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Tjin')){ ?>
    <h2>Tjin</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Urlie Lont')){ ?>
    <h2>Urlie Lont</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	  <?php }elseif(is_category('Vikash Joeglal')){ ?>
    <h2>Vikash Joeglal</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	<?php }elseif(is_category('Intervast Nederland')){ ?>
    <h2>Intervast Nederland</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	<?php }elseif(is_category('Intervast Suriname')){ ?>
    <h2>Intervast Suriname</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	<?php }elseif(is_category('Daniella Thijssen')){ ?>
    <h2>Daniella Thijssen</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	<?php }elseif(is_category('Evert Mehilal')){ ?>
    <h2>Evert Mehilal</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	<?php }elseif(is_category('Sandra Vasilda')){ ?>
    <h2>Sandra Vasilda</h2>
		<div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_aanbieders' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	
	<?php }elseif(is_category('Koopwoningen')){ ?>
    <h2>Koopwoningen</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_koopwoningen' ); ?>
    </div>        
    <?php echo do_shortcode('[search-form-results]'); ?>

    <?php }elseif(is_category('Huurwoningen')){ ?>
    <h2>Huurwoningen</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_huurwoningen' ); ?>
    </div>        
    <?php echo do_shortcode('[search-form-results]'); ?>

    <?php }elseif(is_category('Vakantieaccomodaties')){ ?>
    <h2>Vakantieaccomodaties</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_vakantieacc' ); ?>
    </div>        
    <?php echo do_shortcode('[search-form-results]'); ?>
	
	
	
	

	     
	  <?php }elseif(is_category('Uitverkocht')){ ?>
    <h2>Uitverkocht</h2>
	     
	  <?php }elseif(is_category('Verhuurd')){ ?>
    <h2>Verhuurd</h2>
	    
	  <?php }elseif(is_category('Verkocht')){ ?>
    <h2>Verkocht</h2>

    <?php }elseif(is_category('Nieuwsbriefobjecten')){ ?>
    <h2>Nieuwsbriefobjecten</h2>
	    
	  <?php }elseif(is_category('Verkocht ov')){ ?>
    <h2>Verkocht onder voorbehoud</h2>
	  
	<?php }elseif(is_category('Zakelijke percelen')){ ?>
    <h2>Zakelijke percelen</h2>
    <div id="sort_filter">
      <?php dynamic_sidebar( 'sort_filter_commercieelperc' ); ?>
    </div>
    <?php echo do_shortcode('[search-form-results]'); ?>

    <?php } else {?>  
      <h2><?php //$cat = get_the_category(); echo $cat[0]->cat_name; ?></h2>
    <?php } ?> 

    <div id="objects_inner">
      
	  <?php

$args = array(
    
    'posts_per_page' => get_option( 'posts_per_page' ), // Lets posts per page be configured in the admin area
    'page' => $page,
);

$the_query = new WP_Query( $args );

?>
	  
	  
      <?php if(have_posts()) : ?>
      <?php while(have_posts()) : the_post(); ?>
      
	  
	  <?php if(in_category( 'In prijs verlaagd') ) { ?>
      <div class="object col-md-4 verlaagd">
	  <?php wpfp_link() ?>
		  
      <?php }elseif(in_category( 'Tijdelijk niet beschikbaar')){ ?>
      <div class="object col-md-4 onhold">
		  <?php wpfp_link() ?>
		  
	  <?php }elseif(in_category( 'Uitverkocht')){ ?>
      <div class="object col-md-4 uitverkocht">
		  <?php wpfp_link() ?>
		  
      <?php }elseif(in_category( 'Verhuurd')){ ?>
      <div class="object col-md-4 verhuurd">
		  <?php wpfp_link() ?>
      <?php }elseif(in_category( 'Verkocht')){ ?>
      <div class="object col-md-4 verkocht">
		  <?php wpfp_link() ?>
      <?php }elseif(in_category( 'Verkocht ov')){ ?>
      <div class="object col-md-4 verkocht_ovb">
		  <?php wpfp_link() ?>
	  <?php }elseif(in_category( 'Interne financiering mogelijk')){ ?>
      <div class="object col-md-4 interne_fin">
		  <?php wpfp_link() ?>
		  
	
		  
	 

		  
      <?php }else{ ?>
      <div class="object col-md-4">
		  <?php wpfp_link() ?>
      <?php } ?>
       
	<?php
			// GLIS stikkers
			
				if(in_category('PerceelsID toegekend')){
			    echo '<span class="toegekend"></span>';
				
					}
				
				if(in_category('PerceelsID aangevraagd')){
			    echo '<span class="aangevraagd"></span>';
				
					}
					
				if(in_category('Stichtingovername mogelijk')){
			    echo '<span class="stgovername"></span>';
				
					}	
					
			// GLIS stikker
			
			?>


	   <?php

          $custom_fields = get_post_custom(the_ID);
          $fields = array_keys($custom_fields);

          if (in_array("Thumbnail", $fields)) {
            foreach($custom_fields['Thumbnail'] as $thumb){
              echo '<a href="' . get_permalink() . '"';

              $current_cat = get_query_var("category");
              $cat = get_term_by('id',$current_cat,"category");
              $blog = get_term_by('id',"212","category");
              if (is_category(array(184,120,172,113,119,112,118,110,117,114,197,198,199,120,121,208,209,212))||$cat->parent == $blog->ID) {
                // if (is_category(array(184,120,172,113,119,112,118,110,117,114,197,198,199,120,121,208,209))) {
                echo ' target="_blank" ';
              }
           
              echo '><img src="' . $thumb . '" class="object_img img-responsive" /></a>'; 
            }
          }
        ?>

      
	
		
		<div class="object_inner">
          <?php
		  
		
		  
		    echo '<span class="title">';
            the_title();
      echo '<a href="' . get_permalink() . '"';
      $current_cat = get_query_var("category");
      $cat = get_term_by('id',$current_cat,"category");
      $blog = get_term_by('id',"212","category");
      if (is_category(array(184,120,172,113,119,112,118,110,117,114,197,198,199,120,121,208,209,212))||$cat->parent == $blog->ID) {
        // if (is_category(array(184,120,172,113,119,112,118,110,117,114,197,198,199,120,121,208,209))) {
        echo ' target="_blank" ';
      }
      
      echo '></a>'; 
            echo '</span>';
            if (in_array("Prijs", $fields)) {              
              foreach($custom_fields['Prijs'] as $prijs){
                if($prijs == 'n.o.t.k.' || strpos($prijs, 'vanaf') !== false || strpos($prijs, 'v.a.') !== false || strpos($prijs, 'tot') !== false || strpos($prijs, 'Verhuurd') !== false || strpos($prijs, 'PerceelsID toegekend') !== false || strpos($prijs, 'PerceelsID aangevraagd') !== false || strpos($prijs, 'on hold') !== false || strpos($prijs, 't.e.a.b.') !== false || strpos($prijs, '$') !== false || strpos($prijs, 'Verkocht ovb') !== false || $prijs == 'notk'){
                  echo '<span class="prijs">' . $prijs . '</span>'; 
                }elseif(in_category('verkavelingsprojecten')) {
                  echo '<span class="prijs">v.a. € ' . number_format($prijs,0,",",".") . '</span>';
                }else{
                  echo '<span class="prijs">€ ' . number_format($prijs,0,",",".") . '</span>';
                }
              }
            }
			
			
            if (in_array("Locatie", $fields)) {
              foreach($custom_fields['Locatie'] as $locatie){
                echo '<span class="locatie">' . $locatie . '</span>'; 
              }
            }
            if (in_array("Objectnummer", $fields)) {
              foreach($custom_fields['Objectnummer'] as $objectnummer){
                echo '<span class="objectnummer">#' . $objectnummer . '</span>'; 
              }
            }
            echo '<div class="object_inner_bottom">';
              echo '<div class="object_inner_bottom_left">';
                if (in_array("Type", $fields)) {
                  foreach($custom_fields['Type'] as $type){
                    echo '<span class="type">' . $type . '</span><br />'; 
                  }
                }
                if (in_array("Interieur", $fields)) {
                  foreach($custom_fields['Interieur'] as $interieur){
                    echo '<span class="interieur">'. $interieur .'</span><br />';
                  }
                }
                if (in_array("Titel", $fields)) {
                  foreach($custom_fields['Titel'] as $titel){
                    echo '<span class="titel">' . $titel . '</span><br />'; 
                  }
                }
                if (in_array("Perceel", $fields)) {
                  foreach($custom_fields['Perceel'] as $perceel){
                    if(in_category('verkavelingsprojecten')) {
                      echo '<span class="perceel">Vanaf ' . number_format($perceel,0,",",".") . ' m²</span>'; 
                    }else{
                      echo '<span class="perceel">' . number_format($perceel,0,",",".") . ' m²</span>'; 
                    }
                  }
                }
              echo '</div>';
              
              echo '<div class="object_inner_bottom_right">';

//				echo '<pre>';
//				var_dump($custom_fields['Prijs per m2']);
//				echo '</pre>';

				// if (in_array("Prijs per m2", $fields)) {
				// 	if(in_category('Verkavelingsprojecten')){
				// 		echo '<span class="prijsperm">Vanaf € ' . number_format(end($custom_fields['Prijs per m2']),0,",",".") . ' p/m²</span>'; 
				// 	}elseif(in_category('Alle percelen') || in_category('Zakelijke percelen') || in_category('In prijs verlaagd') && in_category('Alle percelen') || in_category('In prijs verlaagd') && in_category('Zakelijke percelen') || in_category('In prijs verlaagd') && in_category('Verkavelingsprojecten') || in_category('Tijdelijk niet beschikbaar') && in_category('Alle percelen') || in_category('Tijdelijk niet beschikbaar') && in_category('Zakelijke percelen') || in_category('Tijdelijk niet beschikbaar') && in_category('Verkavelingsprojecten') || in_category('Verkocht') && in_category('Alle percelen') || in_category('Verkocht') && in_category('Zakelijke percelen') || in_category('Verkocht') && in_category('Verkavelingsprojecten') || in_category('Verkocht ov') && in_category('Alle percelen') || in_category('Verkocht ov') && in_category('Zakelijke percelen') || in_category('Verkocht ov') && in_category('Verkavelingsprojecten') || in_category('Uitverkocht') && in_category('Alle percelen') || in_category('Uitverkocht') && in_category('Zakelijke percelen') || in_category('Uitverkocht') && in_category('Verkavelingsprojecten')){
        //     echo '<span class="prijsperm">€ ' . number_format(end($custom_fields['Prijs per m2']),0,",",".") . ' p/m²</span>';
				// 	}else{
            
        //   }
        //         }
        if (in_array("Prijs per m2", $fields)) {
          if(in_category('Verkavelingsprojecten')){
            echo '<span class="prijsperm">Vanaf € ' . end($custom_fields['Prijs per m2']) . ' p/m²</span>'; 
          }elseif(in_category('Alle percelen') || in_category('Zakelijke percelen')){
            echo '<span class="prijsperm">€ ' . end($custom_fields['Prijs per m2']) . ' p/m²</span>'; 
          }elseif(in_category('Alle Koopwoningen') || in_category('Huurwoningen') || in_category('Zakelijke kooppanden') ||  in_category('Zakelijke huurpanden') ||  in_category('Nog af te bouwen woningen') || in_category('Nieuwbouwwoningen')){
            echo ''; 
          }else{
            echo '';
            // echo '<span class="prijsperm">€ ' . end($custom_fields['Prijs per m2']) . ' p/m²</span>'; 
          }
        }
                
				
				
        echo '<span class="kamers">'; 
        if (in_array("Kamers", $fields)) {
          foreach($custom_fields['Kamers'] as $kamers){
            echo  $kamers.' kamers'; 
          }
        }else{
          echo '&nbsp;'; 
        }

        echo '</span>'; 



        echo '<span class="slaapkamers">'; 
        if (in_array("Slaapkamers", $fields)) {
          foreach($custom_fields['Slaapkamers'] as $slaapkamers){
            echo $slaapkamers. ' slaapkamers'; 
          }
        }else{
          echo '&nbsp;'; 
        }

        echo '</span>'; 
        echo '<span class="oppervlakte">'; 
        if (in_array("Oppervlakte", $fields)) {
          foreach($custom_fields['Oppervlakte'] as $oppervlakte){
            echo number_format($oppervlakte,0,",",".") . ' m²'; 
          }
        }else{
          echo '&nbsp;'; 
        }

        echo '</span>'; 
				
				

             echo '</div>';
            echo '</div>';
          ?>
        </div>
		
        <div class="object_footer">
          <a href="<?php echo get_permalink(); ?>"
          <?php
          $current_cat = get_query_var("category");
          $cat = get_term_by('id',$current_cat,"category");
          $blog = get_term_by('id',"212","category");
          if (is_category(array(184,120,172,113,119,112,118,110,117,114,197,198,199,120,121,208,209,212))||$cat->parent == $blog->ID) {
            // if (is_category(array(184,120,172,113,119,112,118,110,117,114,197,198,199,120,121,208,209))) {
            echo ' target="_blank" ';
          }
          ?>
          
          ><img src="<?php bloginfo( 'template_url' ); ?>/images/marker_icon.png" class="marker_icon" />
          <span class="info_txt">Meer informatie</span>
          <span><img src="<?php bloginfo( 'template_url' ); ?>/images/info_icon.png" class="info_icon" /></span></a>
  		</div>
     

	 </div>
     
	
	 <?php endwhile; ?>
<div class="navigation">
</div>

<?php endif; ?>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
        
<a href="#" class="scrollToTop"></a>

<?php get_footer(); ?>
