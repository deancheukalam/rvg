function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

$(window).load(function() {
  // Animate loader off screen
  $(".se-pre-con").fadeOut("slow");;
});

jQuery(document).ready(function() {

  var liked = $('.test').html();
  var str = "U heeft geen objecten bewaard. Klik op de hartjes om objecten te bewaren.";
  if(liked.indexOf(str) != -1){
      // alert(str + " found");
  }else{
    $('.menu ul li#menu-item-34465 a').css('background', 'url(wp-content/themes/remyvastgoed/images/bewaard_icon_red.png) no-repeat center');
  }
  
  //hide all inputs except the first one
  $('p.hidep').not(':eq(0)').hide();

  //functionality for add-file link
  $('a.add_file').on('click', function(e){
    //show by click the first one from hidden inputs
    $('p.hidep:not(:visible):first').show();

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
    input_parent.hide();

    e.preventDefault();
  });

  var contentHeight = jQuery(".objects").height();
//  var sidebarHeight = jQuery("body.single .sidebar").height();
  
//  jQuery("#outer").height(conltentHeight);
  jQuery("body.home .sidebar").height(contentHeight - 50);
  jQuery("body.archive .sidebar").height(contentHeight - 50);
  
//  jQuery("body.single .sidebar").height(sidebarHeight);
//  jQuery("body.page #outer").height(contentHeight + 173);

//  if(contentHeight > sidebarHeight){
//    jQuery(".sidebar").height(contentHeight);
//    jQuery("#outer").height(contentHeight + 55);
//    jQuery("body.page #outer").height(contentHeight + 173);
//    jQuery("body.archive #outer").height(contentHeight + 50);
//  }
//
//  if(contentHeight < sidebarHeight){
//    jQuery(".sidebar").height(sidebarHeight);
//    jQuery("#outer").height(sidebarHeight + 55);
//    jQuery("body.page #outer").height(sidebarHeight + 173);
//    jQuery("body.archive #outer").height(sidebarHeight + 50);
//  }
  
  $('<a class="close_btn"><img src="wp-content/themes/remyvastgoed/images/close_btn.png" /></a>').insertAfter(".widget_item:nth-child(1) input.oo1");
  $('<a class="close_btn2"><img src="wp-content/themes/remyvastgoed/images/close_btn.png" /></a>').insertAfter(".widget_item:nth-child(2) input.oo2"); 
  $('<a class="close_btn3"><img src="wp-content/themes/remyvastgoed/images/close_btn.png" /></a>').insertAfter(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][email]']"); 
  $('<a class="close_btn4"><img src="wp-content/themes/remyvastgoed/images/close_btn.png" /></a>').insertAfter(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][firstname]']");  
  
  jQuery("a.close_btn").hide();
  jQuery("a.close_btn2").hide();
  jQuery("a.close_btn3").hide();
  jQuery("a.close_btn4").hide();
  
  jQuery("input.oo1").keyup(function() {
    jQuery("a.close_btn").show();
    if( jQuery(this).val().length === 0 ) {
      jQuery("a.close_btn").hide();
    }
  });
  
  jQuery("input.oo2").keyup(function() {
    jQuery("a.close_btn2").show();
    if( jQuery(this).val().length === 0 ) {
      jQuery("a.close_btn2").hide();
    }
  });
  jQuery(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][email]']").keyup(function() {
    jQuery("a.close_btn3").show();
    if( jQuery(this).val().length === 0 ) {
      jQuery("a.close_btn3").hide();
    }
  });
  jQuery(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][firstname]']").keyup(function() {
    jQuery("a.close_btn4").show();
    if( jQuery(this).val().length === 0 ) {
      jQuery("a.close_btn4").hide();
    }
  });  
  
  jQuery('#mail_form_btn').click(function (e) {
    jQuery('#basic-modal-content').modal();
//    jQuery('.mfp-wrap').css("z-index", "1000");
    jQuery('.mfp-wrap').css("display", "none");
    jQuery('.mfp-bg').css("display", "none");
    
    return false;
  });
  
  jQuery('.small_btn.share').click(function (e) {
    jQuery('.mfp-wrap').css("display", "block");
  });
  
  jQuery("a.close_btn").click(function(){
    jQuery('input.oo1').val("");
    jQuery("a.close_btn").hide();
  });
  jQuery("a.close_btn2").click(function(){
    jQuery('input.oo2').val("");
    jQuery("a.close_btn2").hide();
  });
  jQuery("a.close_btn3").click(function(){
    jQuery('.sidebar form.widget_wysija p.wysija-paragraph input[name="wysija[user][email]"]').val("");
    jQuery("a.close_btn3").hide();
  });
  jQuery("a.close_btn4").click(function(){
    jQuery('.sidebar form.widget_wysija p.wysija-paragraph input[name="wysija[user][firstname]"]').val("");
    jQuery("a.close_btn4").hide();
  });

  jQuery("input#sf-field-3, input#sf-field-5, input#sf-field-7, input#sf-field-1111").attr("placeholder", "0");
  
  jQuery("input#sf-field-6, input#sf-field-8").attr("placeholder", "max m²");
  jQuery("input#sf-field-10").attr("placeholder", "€ 0");
  jQuery("input#sf-field-11").attr("placeholder", "€ min");  
  jQuery("input#sf-field-12").attr("placeholder", "€ max");  
  jQuery(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][email]']").attr("placeholder", "E-mail...");  
  jQuery(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][firstname]']").attr("placeholder", "Naam...");  
  jQuery("body.page-id-20704 input[name='legitimatienum']").attr("placeholder", "Nummer...");  
  jQuery("body.page-id-20702 input[name='legitimatienum']").attr("placeholder", "Nummer...");  
  
//  jQuery('input#sf-field-10, input#sf-field-11, input[name="maandbedrag"], input[name="leenbedrag"], input[name="gewensteverkoopprijs"], input[name="bedrag"]').keyup(function(event) {
//      
//    // skip for arrow keys
//    if(event.which >= 37 && event.which <= 40) return;
//
//    // format number
//    jQuery(this).val(function(index, value) {
//      return value
//        .replace(/\D/g, '')
//        .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
//      ;
//    });
//  });
  
  jQuery('input#sf-field-1, input#sf-field-3, input#sf-field-4, input#sf-field-5, input#sf-field-6, input#sf-field-7, input#sf-field-8, input.wpcf7-tel').keyup(function(event) {
      
    // skip for arrow keys
    if(event.which >= 37 && event.which <= 40) return;

    // format number
    jQuery(this).val(function(index, value) {
      return value
        .replace(/\D/g, '')
      ;
    });
  });
  
   jQuery('.sidebar form.widget_wysija p.wysija-paragraph input[name="wysija[user][firstname]"]').keyup(function(event) {
     var node = $(this);
     node.val(node.val().replace(/[^a-zA-Z]/g,'') ); 
   });
  
  jQuery(".sidebar li:nth-child(9) input[type='checkbox']").attr('checked','true')
  
  jQuery(".mapsmarker").wrap("<div id='newdiv'></div>");
  jQuery(".ngg-galleryoverview").wrap("<div id='newdiv1'></div>");
  jQuery(".gg_galleria_slider_wrap").wrap("<div id='newdiv1'></div>");
  jQuery(".leform").wrap("<div id='newdiv2'></div>");
  
  jQuery("div.widget_item:nth-child(4) li:nth-child(1)").wrap("<div class='drawer-item0'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item0 span").wrap("<div class='drawer-header'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item0 div.sf-widget-checkbox-wrapper").wrap("<div class='drawer-content'></div>");
  
  jQuery("div.widget_item:nth-child(4) li:nth-child(2)").wrap("<div class='drawer-item1'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item1 span").wrap("<div class='drawer-header'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item1 div.sf-widget-checkbox-wrapper").wrap("<div class='drawer-content'></div>");
  
  jQuery("div.widget_item:nth-child(4) li:nth-child(3)").wrap("<div class='drawer-item2'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item2 span").wrap("<div class='drawer-header'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item2 input, div.widget_item:nth-child(4) li:nth-child(4)").wrapAll("<div class='drawer-content'></div>");
  
  jQuery("div.widget_item:nth-child(4) li:nth-child(4)").wrap("<div class='drawer-item3'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item3 span").wrap("<div class='drawer-header'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item3 input, div.widget_item:nth-child(4) li:nth-child(5)").wrapAll("<div class='drawer-content'></div>");
  
  jQuery("div.widget_item:nth-child(4) li:nth-child(5)").wrap("<div class='drawer-item4'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item4 span").wrap("<div class='drawer-header'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item4 input, div.widget_item:nth-child(4) li:nth-child(6)").wrapAll("<div class='drawer-content'></div>");
  
  jQuery("div.widget_item:nth-child(4) li:nth-child(6)").wrap("<div class='drawer-item5'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item5 span").wrap("<div class='drawer-header'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item5 div.sf-widget-checkbox-wrapper").wrap("<div class='drawer-content'></div>");
  
  jQuery("div.widget_item:nth-child(4) li:nth-child(7)").wrap("<div class='drawer-item6'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item6 span").wrap("<div class='drawer-header'></div>");
  jQuery("div.widget_item:nth-child(4) .drawer-item6 input, div.widget_item:nth-child(4) li:nth-child(8)").wrapAll("<div class='drawer-content'></div>");
	
	$(".wp_crm_type_div .wp_crm_input_wrapper, .wp_crm_locatie_div .wp_crm_input_wrapper, .wp_crm_titel_div .wp_crm_input_wrapper").hide();	
	
  	$(".wp_crm_type_div label.wp_crm_input_label").click(function(){
		$(".wp_crm_type_div .wp_crm_input_wrapper").slideToggle();
		$(".wp_crm_type_div .wp_crm_input_label").toggleClass('show');
	});
	
	$(".wp_crm_locatie_div label.wp_crm_input_label").click(function(){
		$(".wp_crm_locatie_div .wp_crm_input_wrapper").slideToggle();
		$(".wp_crm_locatie_div .wp_crm_input_label").toggleClass('show');
	});
	
	$(".wp_crm_titel_div label.wp_crm_input_label").click(function(){
		$(".wp_crm_titel_div .wp_crm_input_wrapper").slideToggle();
		$(".wp_crm_titel_div .wp_crm_input_label").toggleClass('show');
	});
  
//  jQuery("ul.buttons").on("click", "li a", function () {
//    var index = ($(this).parent("li").index() == 0) ? '': jQuery(this).parent("li").index();
//    jQuery(".entry").find("#newdiv"+index).prependTo(".entry");
//  });

  
  
//  jQuery("div.widget_item:nth-child(4) li:nth-child(5) span, div.widget_item:nth-child(4) li:nth-child(7) span").append(jQuery("<span class='unit'>m<sup>2</sup></span>"));
//  jQuery("div.widget_item:nth-child(4) li:nth-child(10) span").append(jQuery("<span class='unit'>&#8364;</span>"));
  
//  jQuery('div.widget_item:nth-child(4) li:nth-child(3)').append(jQuery('div.widget_item:nth-child(4) li:nth-child(4)'));

  jQuery('div.object.verlaagd').append('<div id="verlaagd"></div>');  
  jQuery('div.object.onhold').append('<div id="onhold"></div>');  
  jQuery('div.object.uitverkocht').append('<div id="uitverkocht"></div>');  
  jQuery('div.object.verhuurd').append('<div id="verhuurd"></div>');  
  jQuery('div.object.verkocht').append('<div id="verkocht"></div>');  
  jQuery('div.object.verkocht_ovb').append('<div id="verkocht_ovb"></div>');  
  jQuery('div.object.interne_fin').append('<div id="interne_fin"></div>'); 

  
  jQuery('.entry h2').append(jQuery('input.zoek_wissen'));  
  jQuery('#mail_form').insertBefore('.popup_content div');  
  
  jQuery("#wpc-weather.small .now .time_temperature").append(jQuery("<span class='degree'>&deg; C</span>"));
  
  var url = window.location.href; 
  var objnr = url.split("/")[3];
  var straatnaam = jQuery("h2.title").text();
  jQuery('body.single input[name="your-subject"]').val('Object ' + objnr + ' ' + straatnaam);
  jQuery('body.single input[name="link"]').val(url);
  jQuery('body.single #mail_form input#mailurl').val(url);
  
  function getHighestZ(){
    var highest = -999;

    jQuery("*").each(function() {
      var current = parseInt(jQuery(this).css("z-index"), 10);
      if(current && highest < current) highest = current;
    });

    return highest; 
  }
  
  jQuery(".menu-main-menu-container ul li").mouseover(function(){
    jQuery(this).children('ul').css( "zIndex", getHighestZ() + 1 );
  });
  
  
  var docwidth = $(window).width();
  if (docwidth > 992) {  
    $(function(){ // document ready
      if (!!$('.sticky').offset()) { // make sure ".sticky" element exists
        var stickyTop = $('.sticky').offset().top; // returns number 
        $(window).scroll(function(){ // scroll event        
          var windowTop = $(window).scrollTop(); // returns number 

          if (stickyTop < windowTop){
            $('.sticky').css({ position: 'fixed', top: 0 });
            $('body.archive #outer').css('left','1260px');
            $('body.page #outer').css('left','1244');
          }
          else {
            $('.sticky').css('position','static');
            $('body.archive #outer').css('left','1260px');
            $('body.page #outer').css('left','1244');
          }

        });
      }
      
      $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
          $('.scrollToTop').fadeIn();
        } else {
          $('.scrollToTop').fadeOut();
        }
      });
	
      //Click event to scroll to top
      $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
      });
      
    });    
  }
  
  if (docwidth < 992) { 
    jQuery(".col-md-7.objects.single").insertAfter(jQuery('.col-md-5.sidebar'));
  }
  
  jQuery("body.page-id-19922 #outer").insertAfter(jQuery('body.page-id-19922 .col-md-3.sidebar'));
  jQuery("body.page-id-8454 #outer").insertAfter(jQuery('body.page-id-8454 .col-md-3.sidebar'));
  jQuery(".wysija-msg").insertAfter(jQuery('.wysija-submit'));
  
  jQuery('#inline-popups').magnificPopup({
    delegate: 'a',
    removalDelay: 500, //delay removal by X to allow out-animation
    callbacks: {
      beforeOpen: function() {
         this.st.mainClass = this.st.el.attr('data-effect');
      }
    },
    midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
  });
  
  jQuery(function() {
    jQuery(".drawer-item0").drawer({
      slideSpeed: 200
    });
    
    jQuery(".drawer-item1").drawer({
      slideSpeed: 200
    });
    
    jQuery(".drawer-item2").drawer({
      slideSpeed: 200
    });
    
    jQuery(".drawer-item3").drawer({
      slideSpeed: 200
    });
    
    jQuery(".drawer-item4").drawer({
      slideSpeed: 200
    });
    
    jQuery(".drawer-item5").drawer({
      slideSpeed: 200
    });
    
    jQuery(".drawer-item6").drawer({
      slideSpeed: 200
    });
  });
  
  
  jQuery('.drawer-item0 input[value="Zakelijk perceel"]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery(".drawer-item2").hide();
      jQuery(".drawer-item3").hide();
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery(".drawer-item2").show();
      jQuery(".drawer-item3").show();
    }
  });
  
  jQuery('.drawer-item0 input[value="Perceel"]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery(".drawer-item2").hide();
      jQuery(".drawer-item3").hide();
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery(".drawer-item2").show();
      jQuery(".drawer-item3").show();
    }
  });
  
  jQuery('.drawer-item0 input[value="Zakelijk kooppand"]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery(".drawer-item2").hide();
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery(".drawer-item2").show();
    }
  });
  
  jQuery('.drawer-item0 input[value="Zakelijk huurpand"]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery(".drawer-item2").hide();
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery(".drawer-item2").show();
    }
  });
  
  jQuery('.drawer-item0 input[value="Huurwoning"]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery(".drawer-item4").hide();
      jQuery(".drawer-item5").hide();
		jQuery(".drawer-item5 input[type='checkbox']").prop("checked", false);
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery(".drawer-item4").show();
      jQuery(".drawer-item5").show();
		jQuery(".drawer-item5 input[type='checkbox']").prop("checked", true);
    }
  });
  
  jQuery('.drawer-item0 input[value="Vakantieaccomodatie"]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery(".drawer-item4").hide();
      jQuery(".drawer-item5").hide();
		jQuery(".drawer-item5 input[type='checkbox']").prop("checked", false);
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery(".drawer-item4").show();
      jQuery(".drawer-item5").show();
		jQuery(".drawer-item5 input[type='checkbox']").prop("checked", true);
    }
  });
  
  jQuery('.drawer-item0 input[value="Zakelijk huurpand"]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery(".drawer-item4").hide();
      jQuery(".drawer-item5").hide();
		jQuery(".drawer-item5 input[type='checkbox']").prop("checked", false);
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery(".drawer-item4").show();
      jQuery(".drawer-item5").show();
		jQuery(".drawer-item5 input[type='checkbox']").prop("checked", true);
    }
  });
  
    
  if(getParameterByName("query") == ''){
    jQuery('select option[value="post[date|desc]"]').attr("selected", "selected"); 
  }    
  var options = jQuery('.sort_filter select option');
//  jQuery( options[ 3 ] ).insertAfter( jQuery( options[ 0 ] ) );
//  jQuery( options[ 2 ] ).insertAfter( jQuery( options[ 3 ] ) );
//  jQuery( options[ 0 ] ).insertAfter( jQuery( options[ 2 ] ) );
  
  

  
  if(jQuery("body.archive .objects .sf-wrapper").length > 0){ 
    jQuery('#objects_inner').hide();
  }
  
  jQuery('.drawer-item1 input[value="Commewijne"]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery('input[value*="Commewijne - "]').prop('checked', true );
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery('input[value*="Commewijne - "]').prop('checked', false );
    }
  });
  
  jQuery('.drawer-item1 input[value="Para"]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery('input[value*="Para - "]').prop('checked', true );
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery('input[value*="Para - "]').prop('checked', false );
    }
  });
  
  jQuery('.drawer-item1 input[value="Paramaribo "]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery('input[value*="Paramaribo - "]').prop('checked', true );
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery('input[value*="Paramaribo - "]').prop('checked', false );
    }
  });
  
  jQuery('.drawer-item1 input[value="Saramacca"]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery('input[value*="Saramacca - "]').prop('checked', true );
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery('input[value*="Saramacca - "]').prop('checked', false );
    }
  });
  
  jQuery('.drawer-item1 input[value="Wanica"]').click(function(){
    if(jQuery(this).is(':checked')){
      jQuery('input[value*="Wanica - "]').prop('checked', true );
    }
    else if(jQuery(this).is(':not(:checked)')){
      jQuery('input[value*="Wanica - "]').prop('checked', false );
    }
  });
  
  var table = $('.sidebar .desc table');
  table.eq(1).addClass("voorzieningen");  
  
  jQuery('body.single #newdiv').hide();
  jQuery('body.single #newdiv2').hide();
  jQuery('a.small_btn.photos').addClass('active');
  
  jQuery('a.small_btn.map').click(function(){
    jQuery('a.small_btn.map').addClass('active');
    jQuery('a.small_btn.photos').removeClass('active');
    jQuery('a.small_btn.mail').removeClass('active');
    jQuery('body.single #newdiv').show();
    jQuery('body.single #newdiv .mapsmarker').show();
    jQuery('body.single #newdiv1').hide();
    jQuery('body.single #newdiv2').hide();
  });
  
  jQuery('a.small_btn.photos').click(function(){
    jQuery('a.small_btn.photos').addClass('active');
    jQuery('a.small_btn.map').removeClass('active');
    jQuery('a.small_btn.mail').removeClass('active');
    jQuery('body.single #newdiv').hide();
    jQuery('body.single #newdiv .mapsmarker').hide();
    jQuery('body.single #newdiv1').show();
    jQuery('body.single #newdiv2').hide();
  });
  
  jQuery('a.small_btn.mail').click(function(){
    jQuery('a.small_btn.mail').addClass('active');
    jQuery('a.small_btn.photos').removeClass('active');
    jQuery('a.small_btn.map').removeClass('active');
    jQuery('body.single #newdiv').hide();
    jQuery('body.single #newdiv .mapsmarker').hide();
    jQuery('body.single #newdiv1').hide();
    jQuery('body.single #newdiv2').show();
  });
  
  jQuery('.zoek_wissen').click(function () {
    window.history.back;
  });
  
});