<?php get_header(); ?>
<div id="content">
<?php get_sidebar(); ?>
    <div class="col-md-9 objects">
<?php
//========================== get current active category
$activeCategory =  single_cat_title('' , false);

//=========== toggle session to display firstload block
if (isset($_GET['query'])) {
    $_SESSION['catFilter'] = $activeCategory ;
 }else{
     unset($_SESSION['catFilter']);
 }


//================ category array with sort filter to display in element
    $catArr = [
        'Alle percelen' => 'sort_filter_percelen',
        'Verkavelingsprojecten' => 'sort_filter_verkavelingsproj',
        'Gated community percelen' => 'sort_filter_gated_community_percelen',
        'Commercieel percelen' => 'sort_filter_commercieelperc',
        'Zakelijke kooppanden' => 'sort_filter_commercieelkoopp',
        'Alle koopwoningen' => 'sort_filter_koopwoningen',
        'Nieuwbouwwoningen' => 'sort_filter_nieuwbouwwoningen',
        'Huurwoningen' => 'sort_filter_huurwoningen',
        'Vakantieaccomodaties' => 'sort_filter_vakantieacc',
        'Nog af te bouwen woningen' => 'sort_filter_nog_af_te_bouwen',
        'Gated community woningen' => 'sort_filter_gated_community_woningen',
        'Beleggingspanden' => 'sort_filter_beleggings-panden',
        'Zakelijke huurpanden' => 'sort_filter_commercieelhuurp',
        'Zakelijke percelen' => 'sort_filter_commercieelperc',
        'Ajay Sewpal' => 'sort_filter_aanbieders',
        'Amar Bhagwandas' => 'sort_filter_aanbieders',
        'Anand Baidjoe' => 'sort_filter_aanbieders',
        'Arny de Bruijn' => 'sort_filter_aanbieders',
        'Ashok Harpal' => 'sort_filter_aanbieders',
        'Baal Bhageloe' => 'sort_filter_aanbieders',
        'Bharat Gangadin' => 'sort_filter_aanbieders',
        'Clife Hiwat' => 'sort_filter_aanbieders',
        'Compa' => 'sort_filter_aanbieders',
        'Daniëlla Thijssen' => 'sort_filter_aanbieders',
        'Dennis Yvel' => 'sort_filter_aanbieders',
        'Dinesh Nannan' => 'sort_filter_aanbieders',
        'Erik van Pamelen' => 'sort_filter_aanbieders',
        'Faid Madjoe' => 'sort_filter_aanbieders',
        'Farish Salamat' => 'sort_filter_aanbieders',
        'Faroek Alibux' => 'sort_filter_aanbieders',
        'Fazilah Lalmahomed' => 'sort_filter_aanbieders',
        'Feisal Ghafoerkhan' => 'sort_filter_aanbieders',
        'Ferdy Purperhart' => 'sort_filter_aanbieders',
        'Frans Harnandan' => 'sort_filter_aanbieders',
        'Gaitri Phagoe' => 'sort_filter_aanbieders',
        'Hans Chitoe' => 'sort_filter_aanbieders',
        'Hunfrey Pawiro' => 'sort_filter_aanbieders',
        'Intervast' => 'sort_filter_aanbieders',
        'Jerry Oehlers' => 'sort_filter_aanbieders',
        'John Noble' => 'sort_filter_aanbieders',
        'K. Tikai' => 'sort_filter_aanbieders',
        'Karina Kahn' => 'sort_filter_aanbieders',
        'Kok Tollens' => 'sort_filter_aanbieders',
        'Kries Kalipdewsing' => 'sort_filter_aanbieders',
        'Miquel Spier' => 'sort_filter_aanbieders',
        'Navin Tikaram' => 'sort_filter_aanbieders',
        'Nazir' => 'sort_filter_aanbieders',
        'Omar Ghafoerkhan' => 'sort_filter_aanbieders',
        'Paul Wieman' => 'sort_filter_aanbieders',
        'Piet Badal' => 'sort_filter_aanbieders',
        'Rahiet Kali' => 'sort_filter_aanbieders',
        'Rakesh Goerdin' => 'sort_filter_aanbieders',
        'Ram Fatingan' => 'sort_filter_aanbieders',
        'Ramon Razabsek' => 'sort_filter_aanbieders',
        'Remy van der Hoek' => 'sort_filter_aanbieders',
        'Remy Vastgoed' => 'sort_filter_aanbieders',
        'Rick Leendertse' => 'sort_filter_aanbieders',
        'Rudy Ardjoen' => 'sort_filter_aanbieders',
        'Sabrina Sewnarain' => 'sort_filter_aanbieders',
        'Sameer Natthoe' => 'sort_filter_aanbieders',
        'Sarwan Gopal' => 'sort_filter_aanbieders',
        'Shaike Chitoe' => 'sort_filter_aanbieders',
        'Shawn Bisambhar' => 'sort_filter_aanbieders',
        'Stange Soerjbali' => 'sort_filter_aanbieders',
        'Steven Burgzorg' => 'sort_filter_aanbieders',
        'Subhas Jhauw' => 'sort_filter_aanbieders',
        'Sudhir Ramautar' => 'sort_filter_aanbieders',
        'Teddy Nannanpanday' => 'sort_filter_aanbieders',
        'Theo Mobach' => 'sort_filter_aanbieders',
        'Tjin' => 'sort_filter_aanbieders',
        'Urlie Lont' => 'sort_filter_aanbieders',
        'Vikash Joeglal' => 'sort_filter_aanbieders',
        'Intervast Nederland' => 'sort_filter_aanbieders',
        'Intervast Suriname' => 'sort_filter_aanbieders',
        'Daniella Thijssen' => 'sort_filter_aanbieders',
        'Evert Mehilal' => 'sort_filter_aanbieders',
        'Sandra Vasilda' => 'sort_filter_aanbieders',
        'Expat Housing Suriname' => 'sort_filter_aanbieders',
        'Sandra Slijngard' => 'sort_filter_aanbieders'
    ];


//===================== display heading only categories
if($activeCategory == 'Studentenkamers' ||
    $activeCategory == 'Commercieel onroerend goed' ||
    $activeCategory == 'In prijs verlaagd' ||
    $activeCategory == 'Interne financiering mogelijk' ||
    $activeCategory == 'Tijdelijk niet beschikbaar' ||
    $activeCategory == 'PerceelsID toegekend' ||
    $activeCategory == 'PerceelsID aangevraagd' ||
    $activeCategory == 'Stichtingovername mogelijk' ||
    $activeCategory == 'Advertentieobjecten' ||
    $activeCategory == 'Onderpanden' ||
    $activeCategory == 'Ajay Jilamsing' ||
    $activeCategory == 'Joel Terzol' ||
    $activeCategory == 'Manav Kanhai' ||
    $activeCategory == 'Rachella Kowlesar' ||
    $activeCategory == 'Koos Schols' ||
    $activeCategory == 'Michel Norbruis' ||
    $activeCategory == 'Uitverkocht' ||
    $activeCategory == 'Verhuurd' ||
    $activeCategory == 'Verkocht' ||
    $activeCategory == 'Nieuwsbriefobjecten' ||
    $activeCategory == 'Verkocht ovb'){

    if($activeCategory == 'Verkocht ovb'){
        echo'<h2>Verkocht onder voorbehoud</h2>';
    }else{
        echo'<h2>'.$activeCategory.'</h2>';
    }


}else{

//========= display elements & heading if current active cat is in catArray
    foreach($catArr as $category => $filterName){
        if($category == $activeCategory){
                echo '<h2>'.$category.'</h2>';
                echo'<div id="sort_filter">';
                    dynamic_sidebar($filterName);
                echo'</div>';
                echo do_shortcode('[search-form-results]');
                break;
        }

    }
}

?>



<!-- //============================= objects first load block (display if no filter selected) -->
<?php if(!isset($_SESSION['catFilter'])){  ?>

      <h2> <?php //single_cat_title( '', true ); ?></h2>
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
                <?php }elseif(in_category( 'In bewoonde staat')){ ?>
                <div class="object col-md-4 bewoond">
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
                                <?php }elseif(in_category( 'Verkocht ovb')){ ?>
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
                    glisStickers();
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
                    echo ' target="" ';
                    }

                    echo '><img src="' . $thumb . '" class="object_img img-responsive" /></a>';
                }
}
?>




                    <div class="object_inner">
<?php

                    // Modefied by BOB
                    echo '<a href="' . get_permalink() . '"';
                    echo '<span class="title">';
                    the_title();
                    echo '</a>';
                    echo '</span>';

                    // echo '</a>';

                    echo '<a href="' . get_permalink() . '"';
                    $current_cat = get_query_var("category");
                    $cat = get_term_by('id',$current_cat,"category");
                    $blog = get_term_by('id',"212","category");
if (is_category(array(184,120,172,113,119,112,118,110,117,114,197,198,199,120,121,208,209,212))||$cat->parent == $blog->ID) {
// if (is_category(array(184,120,172,113,119,112,118,110,117,114,197,198,199,120,121,208,209))) {

                    echo ' target="" ';
                    echo '></a>';
}

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
  //   End Modification

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
                                                <a href="<?php echo get_permalink(); ?>"><img
                                                        src="<?php bloginfo( 'template_url' ); ?>/images/marker_icon.png"
                                                        class="marker_icon" />
                                                    <span class="info_txt">Meer informatie</span>
                                                    <span><img
                                                            src="<?php bloginfo( 'template_url' ); ?>/images/info_icon.png"
                                                            class="info_icon" /></span></a>
                                            </div>
                                        </div>

                                        <?php endwhile; ?>



                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                            <div class="wp-pagination">
                                        <!-- <ol class="wp-paginate wpp-modern-grey font-inherit">
                                            <li><span class="page current">1</span></li>
                                            <li><a href="//localhost:8888/remyvastgoed/percelen/page/2" title="2" class="page">2</a></li>
                                            <li><a href="//localhost:8888/remyvastgoed/percelen/page/3" title="3" class="page">3</a></li>
                                            <li><span class="gap">...</span></li>
                                            <li><a href="//localhost:8888/remyvastgoed/percelen/page/24" title="24" class="page">24</a></li>
                                            <li><a href="//localhost:8888/remyvastgoed/percelen/page/2" class="next">»</a></li>
                                        </ol> -->
                            </div>


<?php } ?>
</div>

<a href="#" class="scrollToTop"></a>
<?php get_footer(); ?>
