function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

// BOB Edited HERE

function formatNumber(n) {
    // format number 1000000 to 1.234.567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    // return n.replace(/\D/g, "").replace(/[^0-9|-]/g, ".")
}


function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") { return; }

    // original length
    var original_len = input_val.length;

    // initial caret position 
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(",") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(",");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        // if (blur === "blur") {
        //   right_side += "00";
        // }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        // input_val = "€ " + left_side + "," + right_side;
        input_val = "€ " + left_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = "€ " + input_val;

        // final formatting
        // if (blur === "blur") {
        //   input_val += ",00";
        // }
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function formatDistance(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") { return; }

    // original length
    var original_len = input_val.length;

    // initial caret position 
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(",") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(",");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        // if (blur === "blur") {
        //   right_side += "00";
        // }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        // input_val = "€ " + left_side + "," + right_side;
        input_val = left_side + " m²";

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = input_val + " m²";

        // final formatting
        // if (blur === "blur") {
        //   input_val += " m²";
        // }
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}


function formatDistanceOld(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") { return; }

    // original length
    var original_len = input_val.length;

    // initial caret position 
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(",") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(",");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = left_side + "," + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = input_val;

        // final formatting
        if (blur === "blur") {
            input_val += ",00";
        }
    }

    // send updated string to input
    input.val(input_val + " m²");

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

if ($('body').hasClass('home')) {
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 100) {
            $('#header_outer').addClass('fixed-header');
            //  $('.container #content').addClass('fixed');
            //  $('body.home .container .sidebar').addClass('fixed');
            //  $('body.home .container .objects').addClass('fixed');
            $('.nav-spacer').css('display', 'block');
        } else {
            $('#header_outer').removeClass('fixed-header');
            //  $('.container #content').removeClass('fixed');
            //  $('body.home .container .sidebar').removeClass('fixed');
            //  $('body.home .container .objects').removeClass('fixed');
            $('.nav-spacer').css('display', 'none');
        }
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function () {
        $('html, body').animate({ scrollTop: 100 }, 800);
        return false;
    });
} else {
    $('#header_outer').addClass('fixed-header');
    $('.nav-spacer').css('display', 'block');

    //Click event to scroll to top
    $('.scrollToTop').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 800);
        return false;
    });
}



// $(window).scroll(function() {
//     if ($(window).scrollTop() >= 101) {
//         $('.fixed-spacer').addClass('active');
//     } else {
//         $('.fixed-spacer').removeClass('active');
//     }
// });

// $(window).scroll(function(){
//   if ($(window).scrollTop() >= 1000) {
//      $('body.home .container .sidebar #facebook').addClass('fixed_facebook');
//   }
//   else {
//    $('body.home .container .sidebar #facebook').removeClass('fixed_facebook');
//   }
// });

function goBack() {
    window.history.back()
}


$(window).load(function () {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
});
jQuery(document).ready(function () {

    var fwidth = $('#facebook').width();
    $('#facebook').html('<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fremyvastgoed%2F&tabs=timeline&width=' + fwidth + '&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=192711138031785" width="' + fwidth + '" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>');


    $("#resensiespage p").each(function () {
        var x = $(this).html();
        var y = x.replaceAll('.', '<span class="normaldot">.</span>');
        $(this).html(y);
    });


    $('.small_btn.terug').click(function () {
        window.history.back();
    });

    //GOOGLE MAP FIX, FIRE A RESIZE FUNCTION
    $('a.map.small_btn').click(function () {
        window.dispatchEvent(new Event('resize'));
    });

    //STICKY OVERZICHT PAGINAS
    var archive_content = $('.col-md-9.objects').html();
    $('.col-md-9.objects').html('<div class="objects_container">' + archive_content + '</div>');

    var objs = $('.col-md-9.objects .object').length;
    if (objs > 9 && $(window).width() > 1200) {
        $('.col-md-3.sidebar .sidebar_container').sticky({ topSpacing: 87, bottomSpacing: 110 });
        $('.col-md-9.objects .objects_container').sticky({ topSpacing: 0, bottomSpacing: 93 });
    }

    //stick contact page
    $('#contactpage .maincol iframe').sticky({ topSpacing: 61, bottomSpacing: 123 });

    $('a:contains("Maps Marker Pro is disabled because its trial version expired.")').closest('table').hide();
    $('a:contains("Want to share spots & tracks on your own WordPress site?")').closest('table').hide();

    if ($(window).width() < 1200) {

        $('#contactpage .maincol iframe').unstick();

        $('#header_outer').addClass('fixed-header');
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 0) {
                $('#header_outer').addClass('fixed-header');
            } else {
                $('#header_outer').removeClass('fixed-header');
            }
        });
        // $('body.single .col-md-7').hide();
        // var info = $('body.single .col-md-7').html();
        // $('body.single #content').prepend('<div id="mobile_itemdetail"></div><div id="mobile_iteminfo" class="col-md-7 objects single"></div>');
        // $('#mobile_iteminfo').html(info);

        $('body.single .col-md-5').hide();
        $('body.single .col-md-7').hide();

        $('#object_mobile_title').append($('#top_section'));
        $('#object_mobile_title').append($('.pfp-span'));
        $('#top_section').append('<span class="mlabel ' + $('#bottom_section div:first').attr('class') + '"></span>');

        $('#tabfotos').append($('.gg_galleria_slider_wrap'));
        // move photogallery to top
        $('#object_mobile_title').prepend($('#tabfotos'));
        $('#btn_tabfotos').hide();
        // end move photogallery to top

        $('#tabinfo').append($('#bottom_section'));
        $('#tablocatie').append($('.mapsmarker'));
        $('#tabdelen').append($('.leform2'));
        $('#tabreageren').append($('.leform'));

        $('#object_mobile_tabs .mobilenav a').click(function (e) {
            e.preventDefault()
            $(this).tab('show');
        });

        $('#tablocatie div.mapsmarker').first().remove(); //remove duplicate map
        $('#tabfotos div').first().remove(); //remove duplicate gallery

        //mobile menu btn 
        $('.mobmenu-left-panel').removeClass('show-panel');
        $('.mobile_menubtn').click(function () {
            if (!$('.mobmenu-left-panel').hasClass('show-panel')) {
                $('.mobmenu-left-panel').addClass('show-panel');
                $('.mob-menu-icon.closed').hide();
                $('.mob-menu-icon.open').show();

                //$('#menu-item-86186').removeClass('open');
                //$('#menu-item-86186').addClass('closed');
                //$('#mobilesearch').slideUp();

                // $('#menu-item-84505').removeClass('open');
                // $('#menu-item-84505').addClass('closed');
                // $('#mobilesearch').slideUp();
            } else {
                $('.mobmenu-left-panel').removeClass('show-panel');
                $('.mob-menu-icon.closed').show();
                $('.mob-menu-icon.open').hide();


            }
            return false;
        });

        //close menu if click outside menu
        $(document).on("click", function (event) {
            // If the target is not the container or a child of the container, then process
            // the click event for outside of the container.
            if ($(event.target).closest(".mobmenu-left-panel").length === 0) {
                // console.log("You clicked outside of the container element");
                $('.mobmenu-left-panel').removeClass('show-panel');

                $('.mob-menu-icon.closed').show();
                $('.mob-menu-icon.open').hide();
            }
        });


        // menu-sub-menu
        $('.navbar-header').append($('.menu-sub-menu-container'));

        $('#mobilesearch .oo1').attr('type', 'search');
        $('#mobilesearch .oo1').attr('autocomplete', 'off');

        if ($('#mobilesearch:visible').length > 0) {
            $('#menu-item-84505').addClass('open');
            $('#menu-item-84505').removeClass('closed');
            //$('#menu-item-86186').addClass('open');//fab
            // $('#menu-item-86186').removeClass('closed');//fab

        } else {
            $('#menu-item-84505').removeClass('open');
            $('#menu-item-84505').addClass('closed');
            $('#menu-item-86186').removeClass('open');
            $('#menu-item-86186').addClass('closed');
        }

        $('#menu-item-84505').click(function () {

            if ($('#mobilesearch:visible').length > 0) {

                $('#menu-item-84505').removeClass('open');
                $('#menu-item-84505').addClass('closed');
                $('#mobilesearch').slideUp();
            } else {
                ``
                window.scrollTo(0, 0);
                $('#menu-item-84505').addClass('open');
                $('#menu-item-84505').removeClass('closed');
                $('#mobilesearch').slideDown();

                $('#mobilesearch .oo1').focus();

                $('.mobmenu-left-panel').removeClass('show-panel');
                $('.mob-menu-icon.closed').show();
                $('.mob-menu-icon.open').hide();

            }

            return false;
        });



        let addBtn = false;
        $('#menu-item-86186').click(function () {

            if ($('#mobilesearch:visible').length > 0) {

                $('#menu-item-86186').removeClass('open');
                $('#menu-item-86186').addClass('closed');
                //$('#mobilesearch').slideUp(); //fab
                //$('#mobilesearch').animate({ left: 50 });
                $("#mobilesearch").css({ "left": "500px" }).animate({ "left": "50px" }, "slow");
                //=== add close brn to slide search
                if (addBtn === false) {
                    $('#mobilesearch').append('<div id="close-search"></div>');
                    addBtn = true;
                }
                $('#mobilesearch .oo1').focus();

                //============ close menu left if open
                if ($('.mobmenu-left-panel').hasClass('show-panel')) {
                    $('.mobmenu-left-panel').removeClass('show-panel');
                    $('.mob-menu-icon.closed').show();
                    $('.mob-menu-icon.open').hide();
                }

            } else {
                window.scrollTo(0, 0);
                //$('#menu-item-86186').addClass('open');
                $('#menu-item-86186').removeClass('closed');
                //$('#mobilesearch').slideDown(); //fab              


                $('#mobilesearch .oo1').focus();
                $('.mobmenu-left-panel').removeClass('show-panel');
                $('.mob-menu-icon.closed').show();
                $('.mob-menu-icon.open').hide();
            }

            return false;
        });

    }



    $('ul#menu-main-menu li').mouseover(function () {
        $('.breadcrumbs').hide();
    });
    $('ul#menu-main-menu li').mouseleave(function () {
        $('.breadcrumbs').show();
    });
    // $('body.single #bottom_section .desc').moreContent({
    //   height: 110,
    //   useCss: true,
    //   shadow: true,
    //   textClose: 'Lees meer...',
    //   textOpen: 'Sluiten'
    // })
    $("a.noclick").click(function (e) {
        // Special stuff to do when this link is clicked...
        // Cancel the default action
        e.preventDefault();
    });
    $("ul#menu-main-menu_").materialmenu({
        /**
         * Define width of the window (in pixels) where starts mobile devices.
         * @type integer
         */
        mobileWidth: 768,
        /**
         * Width of the wrapper of menu. Works only on mbile.
         * @type integer
         */
        width: 250,
        /**
         * Time of animation.
         * @type integer
         */
        animationTime: 200,
        /**
         * Overlay opacity.
         * @type integer
         */
        overlayOpacity: 0.4,
        /**
         * Class of menu button that fires showing of menu.
         * @type string
         */
        buttonClass: 'material-menu-button',
        /**
         * If you want, you can define Your own menu button,
         * that be appended to generated title.
         * @type string
         */
        buttonHTML: '<div class="material-menu-button"><span></span><span></span><span></span></div>',
        /**
         * Page title, showed on mobile devices.
         * @type string
         */
        title: '',
        /**
         * Tells if title can be showed on mobile devices (only).
         * @type boolean
         */
        showTitle: false,
        /**
         * Number of pixels to scroll top, when title is showed on mobile devices.
         * If is 0, title will always be visible on top.
         * @type integer
         */
        titleShowOn: 40,
        /**
         * If true, menu will hide when user click on some menu item.
         * @type boolean
         */
        hideOnClick: true,
        /**
         * Fires when menu is opened.
         * @param  jQuery object element Menu (ul) object.
         * @return void
         */
        onOpen: function (element) { },
        /**
         * Fires when menu is closed.
         * @param  jQuery object element Menu (ul) object.
         * @return void
         */
        onClose: function (element) { },
        /**
         * Fires when window width is chenged from desktop to mobile.
         * @param  jQuery object element Menu (ul) object.
         * @return void
         */
        onChangeMobile: function (element) {
            element.parent().parent().addClass('vertical');
        },
        /**
         * Fires when window width is chenged from mobile to desktop.
         * @param  jQuery object element Menu (ul) object.
         * @return void
         */
        onChangeDesktop: function (element) {
            element.parent().parent().removeClass('vertical');
        },
        /**
         * Fires when title-bar is opened.
         * @param  jQuery object element Title-bar object.
         * @return void
         */
        onShowTitlebar: function (element) { },
        /**
         * Fires when title-bar is closed.
         * @param  jQuery object element Title-bar object.
         * @return void
         */
        onHideTitlebar: function (element) { }
    });
    var liked = $('.test').html();
    var str = "U heeft geen objecten bewaard. Klik op de bookmark icon om objecten te bewaren.";
    //var str = "U heeft geen objecten bewaard. Klik op de hartjes om objecten te bewaren.";    
    if (liked.indexOf(str) != -1) {
        // alert(str + " found");
    } else {
        //$('.menu ul li#menu-item-63519 a').css('background', 'url(wp-content/themes/remyvastgoed_2021/images/bewaard_icon_red.png) no-repeat center');
        $('.menu ul li#menu-item-82336 a').css('background', 'url(https://remyvastgoed.com/wp-content/themes/remyvastgoed_2021/images/bewaard_icon_red.png) no-repeat center');
    }
    //hide all inputs except the first one
    $('p.hidep').not(':eq(0)').hide();
    //functionality for add-file link
    $('a.add_file').on('click', function (e) {
        //show by click the first one from hidden inputs
        $('p.hidep:not(:visible):first').show();
        e.preventDefault();
    });
    //functionality for del-file link
    $('a.del_file').on('click', function (e) {
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
    // jQuery("body.home .sidebar").height(contentHeight - 50);
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
    $('<a class="close_btn"><img src="https://www.remyvastgoed.com/wp-content/themes/remyvastgoed_2021/images/search.svg"  style="width: 14px;height: 14px;" /></a>').insertAfter(".header-search input.oo1");
    // $('<a class="close_btn"><img src="https://www.remyvastgoed.com/wp-content/themes/remyvastgoed_2021/images/close_btn.png" /></a>').insertAfter(".widget_item:nth-child(1) input.oo1");
    // $('<a class="close_btn2"><img src="https://www.remyvastgoed.com/wp-content/themes/remyvastgoed_2021/images/close_btn.png" /></a>').insertAfter(".widget_item:nth-child(2) input.oo2"); 
    $('<a class="close_btn3"><img src="https://www.remyvastgoed.com/wp-content/themes/remyvastgoed_2021/images/close_btn.png" /></a>').insertAfter(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][email]']");
    $('<a class="close_btn4"><img src="https://www.remyvastgoed.com/wp-content/themes/remyvastgoed_2021/images/close_btn.png" /></a>').insertAfter(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][firstname]']");
    // jQuery("a.close_btn").hide();
    jQuery("a.close_btn2").hide();
    jQuery("a.close_btn3").hide();
    jQuery("a.close_btn4").hide();
    jQuery("input.oo1").keyup(function () {
        // jQuery("a.close_btn").show();
        jQuery('.header-search input').css('background', 'none');
        if (jQuery(this).val().length === 0) {
            // jQuery("a.close_btn").hide();
            jQuery('.header-search input').css('background', '');
        }
    });
    jQuery("input.oo2").keyup(function () {
        jQuery("a.close_btn2").show();
        if (jQuery(this).val().length === 0) {
            jQuery("a.close_btn2").hide();
        }
    });
    jQuery(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][email]']").keyup(function () {
        jQuery("a.close_btn3").show();
        if (jQuery(this).val().length === 0) {
            jQuery("a.close_btn3").hide();
        }
    });
    jQuery(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][firstname]']").keyup(function () {
        jQuery("a.close_btn4").show();
        if (jQuery(this).val().length === 0) {
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
    jQuery("a.close_btn").click(function () {
        // jQuery('input.oo1').val("");
        // jQuery("a.close_btn").hide();
        // jQuery('.header-search input').css('background','');
        $(".header-search form").submit();
    });
    jQuery("a.close_btn2").click(function () {
        jQuery('input.oo2').val("");
        jQuery("a.close_btn2").hide();
    });
    jQuery("a.close_btn3").click(function () {
        jQuery('.sidebar form.widget_wysija p.wysija-paragraph input[name="wysija[user][email]"]').val("");
        jQuery("a.close_btn3").hide();
    });
    jQuery("a.close_btn4").click(function () {
        jQuery('.sidebar form.widget_wysija p.wysija-paragraph input[name="wysija[user][firstname]"]').val("");
        jQuery("a.close_btn4").hide();
    });
    jQuery("input#sf-field-1111").attr("placeholder", "€ maximaal");
    jQuery("input#sf-field-4").attr("placeholder", "maximaal");
    jQuery("input#sf-field-3, input#sf-field-1010").attr("placeholder", "minimaal");
    jQuery("input#sf-field-7, input#sf-field-5").attr("placeholder", "minimaal m²");
    jQuery("input#sf-field-6, input#sf-field-8").attr("placeholder", "maximaal m²");
    jQuery("input#sf-field-10_").attr("placeholder", "€ 0");
    jQuery("input#sf-field-10, input#sf-field-1010").attr("placeholder", "€ minimaal");
    jQuery("input#sf-field-11,input#sf-field-1111").attr("placeholder", "€ maximaal");


    jQuery("input#sf-field-7, input#sf-field-5, input#sf-field-6, input#sf-field-8").attr("data-type", "distance");
    jQuery("input#sf-field-7, input#sf-field-5, input#sf-field-6, input#sf-field-8").attr("pattern", "^\$\d{1.3}(.\d{3})*(\.\d+)?$²");

    jQuery("input#sf-field-10, input#sf-field-1010, input#sf-field-11,input#sf-field-1111").attr("data-type", "currency");
    jQuery("input#sf-field-10, input#sf-field-1010, input#sf-field-11,input#sf-field-1111").attr("pattern", "^\$\d{1.3}(.\d{3})*(\.\d+)?$");

    // jQuery(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][email]']").attr("placeholder", "E-mail...");  
    // jQuery(".sidebar form.widget_wysija p.wysija-paragraph input[name='wysija[user][firstname]']").attr("placeholder", "Naam..."); 
    jQuery(".sidebar p.mailpoet_paragraph input[type='email']").attr("placeholder", "E-mail...");
    jQuery(".sidebar p.mailpoet_paragraph input[type='text']").attr("placeholder", "Naam...");

    // Bob Custom
    // jQuery("p.mailpoet_paragraph input[type='email']").attr("name", "your-mail");  
    // jQuery("p.mailpoet_paragraph input[type='text']").attr("name", "your-name");
    if ($("input#sf-field-10").val() != undefined) {
        formatCurrency($("input#sf-field-10"));
    }

    if ($("input#sf-field-11").val() != undefined) {
        formatCurrency($("input#sf-field-11"));
    }
    jQuery("body.page-id-20704 input[name='legitimatienum']").attr("placeholder", "Nummer...");
    jQuery("body.page-id-20702 input[name='legitimatienum']").attr("placeholder", "Nummer...");
    jQuery("input[data-type='currency']").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            // formatCurrency($(this), "blur");
        }
    });

    jQuery("input[data-type='distance']").on({
        keyup: function () {
            formatDistance($(this));
        },
        blur: function () {
            // formatDistance($(this), "blur");
        }
    });
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
    jQuery('input#sf-field-1, input#sf-field-3, input#sf-field-4, input#sf-field-5, input#sf-field-6, input#sf-field-7, input#sf-field-8, input.wpcf7-tel').keyup(function (event) {
        // skip for arrow keys
        if (event.which >= 37 && event.which <= 40) return;
        // format number
        jQuery(this).val(function (index, value) {
            return value
                .replace(/\D/g, '');
        });
    });
    jQuery('.sidebar form.widget_wysija p.wysija-paragraph input[name="wysija[user][firstname]"]').keyup(function (event) {
        var node = $(this);
        node.val(node.val().replace(/[^a-zA-Z]/g, ''));
    });
    //check titel if not on search result page
    if (!$('body').hasClass("page-id-19922")) {
        jQuery(".sidebar li:nth-child(9) input[type='checkbox']").attr('checked', 'true');
        // jQuery(".sidebar .drawer-item5 .drawer-content .sf-widget-checkbox-wrapper input[type='checkbox']").attr('checked', 'true');
        jQuery('.sidebar li:nth-child(9) input[type="checkbox"]').parent("label").addClass("checked");
        // jQuery(".sidebar .drawer-item5 div.sf-widget-checkbox-wrapper label").addClass("checked");
    }

    jQuery(".mapsmarker").wrap("<div id='newdiv'></div>");
    jQuery(".ngg-galleryoverview").wrap("<div id='newdiv1'></div>");
    jQuery(".gg_galleria_slider_wrap").wrap("<div id='newdiv1'></div>");
    jQuery(".leform").wrap("<div id='newdiv2'></div>");
    jQuery("div#searchform-widget-3.widget_item li:nth-child(1)").wrap("<div class='drawer-item0'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item0 span").wrap("<div class='drawer-header'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item0 div.sf-widget-checkbox-wrapper").wrap("<div class='drawer-content'></div>");
    jQuery("div#searchform-widget-3.widget_item li:nth-child(2)").wrap("<div class='drawer-item1'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item1 span").wrap("<div class='drawer-header'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item1 div.sf-widget-checkbox-wrapper").wrap("<div class='drawer-content'></div>");
    jQuery("div#searchform-widget-3.widget_item li:nth-child(3)").wrap("<div class='drawer-item2'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item2 span").wrap("<div class='drawer-header'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item2 input, div#searchform-widget-3.widget_item li:nth-child(4)").wrapAll("<div class='drawer-content'></div>");
    jQuery("div#searchform-widget-3.widget_item li:nth-child(4)").wrap("<div class='drawer-item3'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item3 span").wrap("<div class='drawer-header'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item3 input, div#searchform-widget-3.widget_item li:nth-child(5)").wrapAll("<div class='drawer-content'></div>");
    jQuery("div#searchform-widget-3.widget_item li:nth-child(5)").wrap("<div class='drawer-item4'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item4 span").wrap("<div class='drawer-header'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item4 input, div#searchform-widget-3.widget_item li:nth-child(6)").wrapAll("<div class='drawer-content'></div>");
    jQuery("div#searchform-widget-3.widget_item li:nth-child(6)").wrap("<div class='drawer-item5'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item5 span").wrap("<div class='drawer-header'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item5 div.sf-widget-checkbox-wrapper").wrap("<div class='drawer-content'></div>");
    jQuery("div#searchform-widget-3.widget_item li:nth-child(7)").wrap("<div class='drawer-item6'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item6 span").wrap("<div class='drawer-header'></div>");
    jQuery("div#searchform-widget-3.widget_item .drawer-item6 input, div#searchform-widget-3.widget_item li:nth-child(8)").wrapAll("<div class='drawer-content'></div>");
    $(".wp_crm_type_div .wp_crm_input_wrapper, .wp_crm_locatie_div .wp_crm_input_wrapper, .wp_crm_titel_div .wp_crm_input_wrapper").hide();
    $(".wp_crm_type_div label.wp_crm_input_label").click(function () {
        $(".wp_crm_type_div .wp_crm_input_wrapper").slideToggle();
        $(".wp_crm_type_div .wp_crm_input_label").toggleClass('show');
    });
    $(".wp_crm_locatie_div label.wp_crm_input_label").click(function () {
        $(".wp_crm_locatie_div .wp_crm_input_wrapper").slideToggle();
        $(".wp_crm_locatie_div .wp_crm_input_label").toggleClass('show');
    });
    $(".wp_crm_titel_div label.wp_crm_input_label").click(function () {
        $(".wp_crm_titel_div .wp_crm_input_wrapper").slideToggle();
        $(".wp_crm_titel_div .wp_crm_input_label").toggleClass('show');
    });
    //  jQuery("ul.buttons").on("click", "li a", function () {
    //    var index = ($(this).parent("li").index() == 0) ? '': jQuery(this).parent("li").index();
    //    jQuery(".entry").find("#newdiv"+index).prependTo(".entry");
    //  });
    //  jQuery("div#searchform-widget-3.widget_item li:nth-child(5) span, div#searchform-widget-3.widget_item li:nth-child(7) span").append(jQuery("<span class='unit'>m<sup>2</sup></span>"));
    //  jQuery("div#searchform-widget-3.widget_item li:nth-child(10) span").append(jQuery("<span class='unit'>&#8364;</span>"));
    //  jQuery('div#searchform-widget-3.widget_item li:nth-child(3)').append(jQuery('div#searchform-widget-3.widget_item li:nth-child(4)'));
    jQuery('div.object.bewoond').append('<div id="bewoond"></div>');
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

    function getHighestZ() {
        var highest = -999;
        jQuery("*").each(function () {
            var current = parseInt(jQuery(this).css("z-index"), 10);
            if (current && highest < current) highest = current;
        });
        return highest;
    }
    jQuery(".menu-main-menu-container ul li").mouseover(function () {
        jQuery(this).children('ul').css("zIndex", getHighestZ() + 1);
    });
    var docwidth = $(window).width();
    if (docwidth > 992) {
        $(function () { // document ready
            if (!!$('.sticky').offset()) { // make sure ".sticky" element exists
                var stickyTop = $('.sticky').offset().top; // returns number 
                $(window).scroll(function () { // scroll event        
                    var windowTop = $(window).scrollTop(); // returns number 
                    if (stickyTop < windowTop) {
                        $('.sticky').css({ position: 'fixed', bottom: '-118px' });
                        $('body.archive #outer').css('left', '1260px');
                        $('body.page #outer').css('left', '1244');
                    } else {
                        $('.sticky').css('position', 'static');
                        $('body.archive #outer').css('left', '1260px');
                        $('body.page #outer').css('left', '1244');
                    }
                });
            }
            // Bob Custom
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('.scrollToTop').fadeIn();
                } else {
                    $('.scrollToTop').fadeOut();
                }
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
            beforeOpen: function () {
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        },
        midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
    });

    jQuery(function () {
        jQuery(".drawer-item0").drawer({
            slideSpeed: 200
        });
        jQuery(".drawer-item0 > li.sf-widget-element:nth-child(1):before").drawer({
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
    jQuery('.drawer-item0 input[value="Zakelijk perceel"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery(".drawer-item2").hide();
            jQuery(".drawer-item3").hide();
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery(".drawer-item2").show();
            jQuery(".drawer-item3").show();
        }
    });
    jQuery('.drawer-item0 input[value="Perceel"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery(".drawer-item2").hide();
            jQuery(".drawer-item3").hide();
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery(".drawer-item2").show();
            jQuery(".drawer-item3").show();
        }
    });
    jQuery('.drawer-item0 input[value="Zakelijk kooppand"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery(".drawer-item2").hide();
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery(".drawer-item2").show();
        }
    });
    jQuery('.drawer-item0 input[value="Zakelijk huurpand"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery(".drawer-item2").hide();
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery(".drawer-item2").show();
        }
    });
    jQuery('.drawer-item0 input[value="Huurwoning"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery(".drawer-item4").hide();
            jQuery(".drawer-item5").hide();
            jQuery(".drawer-item5 input[type='checkbox']").prop("checked", false);
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery(".drawer-item4").show();
            jQuery(".drawer-item5").show();
            jQuery(".drawer-item5 input[type='checkbox']").prop("checked", true);
        }
    });
    jQuery('.drawer-item0 input[value="Vakantieaccomodatie"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery(".drawer-item4").hide();
            jQuery(".drawer-item5").hide();
            jQuery(".drawer-item5 input[type='checkbox']").prop("checked", false);
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery(".drawer-item4").show();
            jQuery(".drawer-item5").show();
            jQuery(".drawer-item5 input[type='checkbox']").prop("checked", true);
        }
    });
    jQuery('.drawer-item0 input[value="Zakelijk huurpand"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery(".drawer-item4").hide();
            jQuery(".drawer-item5").hide();
            jQuery(".drawer-item5 input[type='checkbox']").prop("checked", false);
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery(".drawer-item4").show();
            jQuery(".drawer-item5").show();
            jQuery(".drawer-item5 input[type='checkbox']").prop("checked", true);
        }
    });
    jQuery('.sidebar div.sf-widget-checkbox-wrapper label input[type="checkbox"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery(this).parent("label").addClass("checked");
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery(this).parent("label").removeClass("checked");
        }
    });
    if (getParameterByName("query") == '') {
        jQuery('select option[value="post[date|desc]"]').attr("selected", "selected");
    }
    var options = jQuery('.sort_filter select option');
    //  jQuery( options[ 3 ] ).insertAfter( jQuery( options[ 0 ] ) );
    //  jQuery( options[ 2 ] ).insertAfter( jQuery( options[ 3 ] ) );
    //  jQuery( options[ 0 ] ).insertAfter( jQuery( options[ 2 ] ) );
    if (jQuery("body.archive .objects .sf-wrapper").length > 0) {
        jQuery('#objects_inner').hide();
    }

    //check type chcekboxes and recheck
    jQuery(".sidebar .drawer-item0 input[type='checkbox'], .sidebar .drawer-item1 input[type='checkbox'], .page-id-19922 .sidebar .drawer-item5 input[type='checkbox']").each(function () {
        if (jQuery(this).is(':checked')) {
            jQuery(this).addClass('atjek');
            jQuery(this).attr('checked', false);
            // console.log('TEST');
        }
    });
    jQuery('.atjek').click();

    //remove all admin defined districts
    jQuery('.drawer-item1 label').each(function () {
        var locatie = jQuery(this).children('input');
        if (locatie.attr('value') != undefined) {
            if (locatie.attr('value').trim() == 'Commewijne') jQuery(this).remove();
            if (locatie.attr('value').trim() == 'Paramaribo') jQuery(this).remove();
            if (locatie.attr('value').trim() == 'Para') jQuery(this).remove();
            if (locatie.attr('value').trim() == 'Saramacca') jQuery(this).remove();
            if (locatie.attr('value').trim() == 'Wanica') jQuery(this).remove();
        }
    });

    jQuery('.drawer-item1 label:contains("Commewijne - "):first()').before('<label><input type="checkbox" value="Commewijne" name="2[]">Commewijne</label>');
    jQuery('.drawer-item1 label:contains("Paramaribo - "):first()').before('<label><input type="checkbox" value="Paramaribo " name="2[]">Paramaribo</label>');
    jQuery('.drawer-item1 label:contains("Para - "):first()').before('<label><input type="checkbox" value="Para " name="2[]">Para</label>');
    jQuery('.drawer-item1 label:contains("Saramacca - "):first()').before('<label><input type="checkbox" value="Saramacca" name="2[]">Saramacca</label>');
    jQuery('.drawer-item1 label:contains("Wanica - "):first()').before('<label><input type="checkbox" value="Wanica" name="2[]">Wanica</label>');

    jQuery('.drawer-item1 input[value="Commewijne"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery('input[value^="Commewijne"]').prop('checked', true);
            jQuery('input[value^="Commewijne"]').parent('label').addClass('checked');
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery('input[value^="Commewijne"]').prop('checked', false);
            jQuery('input[value^="Commewijne"]').parent('label').removeClass('checked');
        }
    });
    jQuery('.drawer-item1 input[value="Paramaribo "]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery('input[value^="Paramaribo"]').prop('checked', true);
            jQuery('input[value^="Paramaribo"]').parent('label').addClass('checked');
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery('input[value^="Paramaribo"]').prop('checked', false);
            jQuery('input[value^="Paramaribo"]').parent('label').removeClass('checked');
        }
    });
    jQuery('.drawer-item1 input[value="Saramacca"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery('input[value^="Saramacca"]').prop('checked', true);
            jQuery('input[value^="Saramacca"]').parent('label').addClass('checked');
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery('input[value^="Saramacca"]').prop('checked', false);
            jQuery('input[value^="Saramacca"]').parent('label').removeClass('checked');
        }
    });
    jQuery('.drawer-item1 input[value="Wanica"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery('input[value^="Wanica"]').prop('checked', true);
            jQuery('input[value^="Wanica"]').parent('label').addClass('checked');
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery('input[value^="Wanica"]').prop('checked', false);
            jQuery('input[value^="Wanica"]').parent('label').removeClass('checked');
        }
    });
    jQuery('.drawer-item1 input[value="Para "]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery('input[value^="Para "]').prop('checked', true);
            jQuery('input[value^="Para "]').parent('label').addClass('checked');
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery('input[value^="Para "]').prop('checked', false);
            jQuery('input[value^="Para "]').parent('label').removeClass('checked');
        }
    });
    jQuery('.drawer-item1 input[value="Saramacca"]').click(function () {
        if (jQuery(this).is(':checked')) {
            jQuery('input[value^="Saramacca"]').prop('checked', true);
            jQuery('input[value^="Saramacca"]').parent('label').addClass('checked');
        } else if (jQuery(this).is(':not(:checked)')) {
            jQuery('input[value^="Saramacca"]').prop('checked', false);
            jQuery('input[value^="Saramacca"]').parent('label').removeClass('checked');
        }
    });

    var table = $('.sidebar .desc table');
    table.eq(1).addClass("voorzieningen");
    jQuery('body.single #newdiv').hide();
    jQuery('body.single #newdiv2').hide();
    jQuery('body.single #newdiv3').hide();
    jQuery('a.small_btn.photos').addClass('active');
    jQuery('a.small_btn.map').click(function () {
        jQuery('a.small_btn.map').addClass('active');
        jQuery('a.small_btn.photos').removeClass('active');
        jQuery('a.small_btn.mail').removeClass('active');
        jQuery('a.small_btn.share').removeClass('active');
        jQuery('body.single #newdiv').show();
        jQuery('body.single #newdiv .mapsmarker').show();
        jQuery('body.single #newdiv1').hide();
        jQuery('body.single #newdiv2').hide();
        jQuery('body.single #newdiv3').hide();
    });
    jQuery('a.small_btn.photos').click(function () {
        jQuery('a.small_btn.photos').addClass('active');
        jQuery('a.small_btn.map').removeClass('active');
        jQuery('a.small_btn.mail').removeClass('active');
        jQuery('a.small_btn.share').removeClass('active');
        jQuery('body.single #newdiv').hide();
        jQuery('body.single #newdiv .mapsmarker').hide();
        jQuery('body.single #newdiv1').show();
        jQuery('body.single #newdiv2').hide();
        jQuery('body.single #newdiv3').hide();
    });
    jQuery('a.small_btn.mail').click(function () {
        jQuery('a.small_btn.mail').addClass('active');
        jQuery('a.small_btn.photos').removeClass('active');
        jQuery('a.small_btn.map').removeClass('active');
        jQuery('a.small_btn.share').removeClass('active');
        jQuery('body.single #newdiv').hide();
        jQuery('body.single #newdiv .mapsmarker').hide();
        jQuery('body.single #newdiv1').hide();
        jQuery('body.single #newdiv2').show();
        jQuery('body.single #newdiv3').hide();
    });
    jQuery('a.small_btn.share').click(function () {
        jQuery('a.small_btn.share').addClass('active');
        jQuery('a.small_btn.mail').removeClass('active');
        jQuery('a.small_btn.photos').removeClass('active');
        jQuery('a.small_btn.map').removeClass('active');
        jQuery('body.single #newdiv').hide();
        jQuery('body.single #newdiv .mapsmarker').hide();
        jQuery('body.single #newdiv1').hide();
        jQuery('body.single #newdiv2').hide();
        jQuery('body.single #newdiv3').show();
    });

    jQuery('.zoek_wissen').click(function () {
        window.history.back;
    });

    // jQuery("a.wpfp-link img").mouseover(function(){this.src="http://mia.bitdynamics.sr/remyvastgoed/wp-content/plugins/wp-favorite-posts/img/bookmark_liked.png"}).mouseout(function(){this.src="//mia.bitdynamics.sr/remyvastgoed/wp-content/plugins/wp-favorite-posts/img/bookmark.png"});

    //BOB
    // Validate min and max price in sidebar search
    jQuery('body').on('keyup', '#sf-field-11', function () {

        var minprice = parseFloat(jQuery('#sf-field-10').val().replace("€ ", "").replaceAll(".", ""));
        var maxprice = parseFloat(jQuery('#sf-field-11').val().replace("€ ", "").replaceAll(".", ""));

        console.log("-" + minprice + "-" + maxprice + "-");
        console.log(typeof (minprice));
        console.log(typeof (maxprice));

        if (minprice != '' && maxprice != '') {
            if (maxprice < minprice) {
                jQuery('#sf-field-11').css('color', '#db2719');
                jQuery('#sf-field-10').css('color', '#000');
            } else {
                jQuery('#sf-field-11').css('color', '#000');
                jQuery('#sf-field-10').css('color', '#000');

            }
        }
    });

    jQuery('body').on('keyup', '#sf-field-10', function () {

        var minprice = parseFloat(jQuery('#sf-field-10').val().replace("€ ", "").replaceAll(".", ""));
        var maxprice = parseFloat(jQuery('#sf-field-11').val().replace("€ ", "").replaceAll(".", ""));

        console.log("-" + minprice + "-" + maxprice + "-");
        console.log(typeof (minprice));
        console.log(typeof (maxprice));

        if (minprice != '' && maxprice != '' && typeof (minprice)) {
            if (maxprice < minprice) {
                jQuery('#sf-field-10').css('color', '#db2719');
                jQuery('#sf-field-11').css('color', '#000');
            } else {
                jQuery('#sf-field-10').css('color', '#000');
                jQuery('#sf-field-11').css('color', '#000');
            }
        }
    });

    //BOB
    // Validate min and max perceel oppervlakte in sidebar search

    if ($('#sf-field-7').length) formatDistance(jQuery('#sf-field-7'));
    if ($('#sf-field-8').length) formatDistance(jQuery('#sf-field-8'));
    jQuery('body').on('keyup', '#sf-field-8', function () {

        formatDistance(jQuery('#sf-field-7'));
        formatDistance(jQuery('#sf-field-8'));

        var minPerc = parseFloat(jQuery('#sf-field-7').val().replace(" m²", "").replaceAll(".", ""));
        var maxPerc = parseFloat(jQuery('#sf-field-8').val().replace(" m²", "").replaceAll(".", ""));

        console.log("-" + minPerc + "-" + maxPerc + "-");
        console.log(typeof (minPerc));
        console.log(typeof (maxPerc));

        if (minPerc != '' && maxPerc != '') {
            if (maxPerc < minPerc) {
                jQuery('#sf-field-8').css('color', '#db2719');
                jQuery('#sf-field-7').css('color', '#000');
            } else {
                jQuery('#sf-field-8').css('color', '#000');
                jQuery('#sf-field-7').css('color', '#000');

            }
        }
    });

    jQuery('body').on('keyup', '#sf-field-7', function () {

        formatDistance(jQuery('#sf-field-7'));
        formatDistance(jQuery('#sf-field-8'));

        var minPerc = parseFloat(jQuery('#sf-field-7').val().replace(" m²", "").replaceAll(".", ""));
        var maxPerc = parseFloat(jQuery('#sf-field-8').val().replace(" m²", "").replaceAll(".", ""));

        console.log("-" + minPerc + "-" + maxPerc + "-");
        console.log(typeof (minPerc));
        console.log(typeof (maxPerc));

        if (minPerc != '' && maxPerc != '') {
            if (maxPerc < minPerc) {
                jQuery('#sf-field-7').css('color', '#db2719');
                jQuery('#sf-field-8').css('color', '#000');
            } else {
                jQuery('#sf-field-7').css('color', '#000');
                jQuery('#sf-field-8').css('color', '#000');

            }
        }
    });

    //BOB
    // Validate min and max bouw oppervlakte in sidebar search

    if ($('#sf-field-5').length) formatDistance(jQuery('#sf-field-5'));
    if ($('#sf-field-6').length) formatDistance(jQuery('#sf-field-6'));
    jQuery('body').on('keyup', '#sf-field-6', function () {

        formatDistance(jQuery('#sf-field-5'));
        formatDistance(jQuery('#sf-field-6'));

        var minBo = parseFloat(jQuery('#sf-field-5').val().replace(" m²", "").replaceAll(".", ""));
        var maxBo = parseFloat(jQuery('#sf-field-6').val().replace(" m²", "").replaceAll(".", ""));

        console.log("-" + minBo + "-" + maxBo + "-");
        console.log(typeof (minBo));
        console.log(typeof (maxBo));

        if (minBo != '' && maxBo != '') {
            if (maxBo < minBo) {
                jQuery('#sf-field-6').css('color', '#db2719');
                jQuery('#sf-field-5').css('color', '#000');
            } else {
                jQuery('#sf-field-6').css('color', '#000');
                jQuery('#sf-field-5').css('color', '#000');

            }
        }
    });

    jQuery('body').on('keyup', '#sf-field-5', function () {

        formatDistance(jQuery('#sf-field-5'));
        formatDistance(jQuery('#sf-field-6'));

        var minBo = parseFloat(jQuery('#sf-field-5').val().replace(" m²", "").replaceAll(".", ""));
        var maxBo = parseFloat(jQuery('#sf-field-6').val().replace(" m²", "").replaceAll(".", ""));

        console.log("-" + minBo + "-" + maxBo + "-");
        console.log(typeof (minBo));
        console.log(typeof (maxBo));

        if (minBo != '' && maxBo != '') {
            if (maxBo < minBo) {
                jQuery('#sf-field-5').css('color', '#db2719');
                jQuery('#sf-field-6').css('color', '#000');
            } else {
                jQuery('#sf-field-5').css('color', '#000');
                jQuery('#sf-field-6').css('color', '#000');

            }
        }
    });

    //BOB
    // Validate min and max slaapkamer oppervlakte in sidebar search slaapkamer
    jQuery('body').on('keyup', '#sf-field-4', function () {

        var minSl = parseFloat(jQuery('#sf-field-3').val());
        var maxSl = parseFloat(jQuery('#sf-field-4').val());

        console.log("-" + minSl + "-" + maxSl + "-");
        console.log(typeof (minSl));
        console.log(typeof (maxSl));

        if (minSl != '' && maxSl != '') {
            if (maxSl < minSl) {
                jQuery('#sf-field-4').css('color', '#db2719');
                jQuery('#sf-field-3').css('color', '#000');
            } else {
                jQuery('#sf-field-4').css('color', '#000');
                jQuery('#sf-field-3').css('color', '#000');

            }
        }
    });

    jQuery('body').on('keyup', '#sf-field-3', function () {

        var minSl = parseFloat(jQuery('#sf-field-3').val());
        var maxSl = parseFloat(jQuery('#sf-field-4').val());

        console.log("-" + minSl + "-" + maxSl + "-");
        console.log(typeof (minSl));
        console.log(typeof (maxSl));

        if (minSl != '' && maxSl != '') {
            if (maxSl < minSl) {
                jQuery('#sf-field-3').css('color', '#db2719');
                jQuery('#sf-field-4').css('color', '#000');
            } else {
                jQuery('#sf-field-3').css('color', '#000');
                jQuery('#sf-field-4').css('color', '#000');

            }
        }
    });
    document.styleSheets[0].insertRule('a.title:visited { color: #187900; }', 0);
    document.styleSheets[0].cssRules[0].style.Color = '#187900';



});

// Bob Custom
jQuery('body').on('keyup', '#one', function Copydata() {
    var two = document.getElementById('iframe').contentWindow.document.getElementById('two')
    $(two).val($("#one").val());
    src = "https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"
});

// Bob Custom
// trigger second button
$(".wpcf7-submit").click(function () {
    var second = document.getElementById('iframe').contentWindow.document.getElementById('second')
    $(second).click();
    return true;
});


//Bob Custom
//Copy to clipboard
function copyClipboard() {
    var copyText = document.getElementById("mailurl");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    // alert("Copied the text: " + copyText.value + " to clipboard");
    alert("Gekopieerd naar klembord");
}


function check_visited_links() {
    var visited_links = JSON.parse(localStorage.getItem('visited_links')) || [];

    $('a').each(function () {
        if (visited_links.indexOf($(this).attr('href')) !== -1) {
            $(this).addClass('visited');
        }
    });

    $('body').on('click', 'a', function () {
        var clicked_url = $(this).attr('href');

        if (visited_links.indexOf(clicked_url) == -1) {
            visited_links.push(clicked_url);
            localStorage.setItem('visited_links', JSON.stringify(visited_links));
        }
    });
}

check_visited_links();

//mobile menu
$(document).ready(function () {

    $('#mobmenuleft li a').not('#mobmenuleft > li li a').click(function () {
        if ($(this).parent().find('ul.sub-menu').is(":hidden")) {
            $(this).parent().find('ul.sub-menu').css('display', 'block');
            $(this).parent().find('.mob-icon-up-open').addClass('show').removeClass('hide');
            $(this).parent().find('.mob-icon-down-open').addClass('hide').removeClass('show');
        } else {
            $(this).parent().find('ul.sub-menu').css('display', 'none');
            $(this).parent().find('.mob-icon-up-open').addClass('hide').removeClass('show');
            $(this).parent().find('.mob-icon-down-open').addClass('show').removeClass('hide');
        }
    });
});

//=============================== fab script

//=================================== toggle submit btn opacity if input > 0
//=== on startup set submit btn opacity
$(document).ready(function () {
    $('a.close_btn').attr('style','opacity:60%;');  
    //=== disable submit btn if input is empty  
    document.querySelector('.close_btn').style.pointerEvents = 'none';
    //=== disable submit btn if input is empty (mobile)
    document.querySelector('.sf-button-btnsearch').style.pointerEvents = 'none';
    
});

//=== toggle submit btn opacity if input > 0
$("input.oo1").on('input',function() {
    if($(this).val().length === 0){
        $('a.close_btn').attr('style','opacity:60%;');
        //=== disable submit btn if input is empty  
        document.querySelector('.close_btn').style.pointerEvents = 'none';
          //=== disable submit btn if input is empty (mobile)
    document.querySelector('.sf-button-btnsearch').style.pointerEvents = 'none';
          
    }else{
        $('a.close_btn').attr('style','opacity:100%;');
        //=== enable submit btn if input not empty  
        document.querySelector('.close_btn').style.pointerEvents = 'auto';
          //=== enable submit btn if input not empty (mobile)
    document.querySelector('.sf-button-btnsearch').style.pointerEvents = 'auto';
        
    } 
});



//================================== add count value to zoekresultaten
let displayTextResult = document.getElementsByClassName('sf-foundcount');
if (displayTextResult.length > 0) {
    $("div.entry > h2").append("<span id='search-counter'>(" + displayTextResult[0].textContent.replace(' results', '') + ")</span>");
}



//============================= clear all on wissen click and unset chkboxes fix
$(".sf-button-btnreset").click(function () {
    let typeList = document.querySelectorAll(".sf-widget-checkbox-wrapper")[0].children;
    let locationlist = document.querySelectorAll(".sf-widget-checkbox-wrapper")[1].children;

    //==== type chkbox loop
    for (let x = 0; x < typeList.length; x++) {
        if ($(typeList[x]).hasClass('checked')) {
            $(typeList[x]).removeClass('checked');
            $(typeList[x].firstChild).attr("checked", false);
        }

    }

    //=========== location chkbox loop 
    for (let y = 0; y < locationlist.length; y++) {
        if ($(locationlist[y]).hasClass('checked')) {
            $(locationlist[y]).removeClass('checked');
            $(locationlist[y].firstChild).attr("checked", false);
        }

    }



});

//======================== disable / enable scroll & links on body in mobile view
let lockScroll = false;
let disableLinks = function () {
    return false;
};
//=== hamburger menu icon click
$(".mob-menu-icon").click(function () {
    if (lockScroll === false) {
        //=== disable scroll on body  
        $('body').attr('style', 'position:fixed;width:100%;');
        // === disable all links in content div
        $('#content a').bind('click', disableLinks);
        lockScroll = true;
    } else {
        $('body').attr('style', 'position:static;width:100%;');
        $('#content a').unbind('click', disableLinks);
        lockScroll = false;

    }


});

//=== seacrh btn top right click
$("li a.visited").click(function () {
    if (lockScroll) {
        $('body').attr('style', 'position:static;width:100%;');
        $('#content a').unbind('click', disableLinks);
        lockScroll = false;
    }

});


//=== if click outside menu enable scroll and links
$(document).on("click", function () {
    if (lockScroll) {
        $('body').attr('style', 'position:static;width:100%;');
        $('#content a').unbind('click', disableLinks);
        lockScroll = false;
    }

});


//=========================== slide search to left (close search) fix
//=== slide search to right (close search)
$(document).on("click", "#close-search", function () {
    //=== slide menu to right
    $('#mobilesearch').animate({ left: 500 });

});








//=========================================== close mobile menu on swip fix


// $('.mobmenu-left-panel').on("swipeleft", function () {
//     $('.mobmenu-left-panel').removeClass('show-panel');
//     $('.mob-menu-icon.closed').show();
//     $('.mob-menu-icon.open').hide();
// });









//================================= end fab script
