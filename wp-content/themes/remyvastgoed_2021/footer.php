  </div>
 <div id="sticky-footer-helper"></div>
</div><!--end content wrapper-->

<!--popup code-->
<div id="overlay"></div>
<div id="popup">
    <div class="popupcontrols">
        <i id="popupclose" class="mob-icon-cancel mob-menu-icon open"></i>
        <!-- <span id="popupclose"><i id="popupclose" class="mob-icon-cancel mob-menu-icon open"></i></span> -->

    </div>
    <div class="popupcontent">
        <img id="popup-image" src=""></img>
    </div>
</div>

<!--end of popup code-->


  <div class="footer">
    <footer>
      <div class="container">

<a class="kaarticons" href="https://www.facebook.com/remyvastgoed/" target="_blank">
   <p class="kaarticons"><img src="<?php bloginfo( 'template_url' ); ?>/images/facebookfooter.png" title="Facebook" /></p>
</a>
<a class="kaarticons" href="https://www.instagram.com/remyvastgoed/" target="_blank">
  <p class="kaarticons"><img src="<?php bloginfo( 'template_url' ); ?>/images/instagramfooter.png" title="Instagram" /></p>
</a>
<a class="kaarticons" href="https://twitter.com/remyvastgoed" target="_blank">
   <p class="kaarticons"><img src="<?php bloginfo( 'template_url' ); ?>/images/twitterfooter.png" title="Twitter" /></p>
</a>


        <p class="terms"><a href="contact">Contact</a> | <a href="algemenevoorwaarden">Algemene voorwaarden</a> | <a href="disclaimer">Disclaimer</a> | <a href="privacy">Privacybeleid</a></p>
        <p class="copyright">&copy; <?php echo date("Y"); ?> Remy Vastgoed NV. Alle rechten voorbehouden.</p>

      </div>

    </footer>
  </div>



  <!-- Don't forget analytics -->
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.magnific-popup.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.drawer.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.simplemodal.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.morecontent.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/materialmenu.jquery.min.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.sticky.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/main.js?v=<?php echo time(); ?>"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/swiped-events.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/pop-up.js"></script>


  <!-- <script src="<?php //bloginfo('template_url'); ?>/js/jquery.mobile-1.4.5.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mobile/1.4.1/jquery.mobile.min.js"></script>	 -->


  <?php wp_footer(); ?>
  <?php
  if ( is_user_logged_in() ) {
  ?>
    <script>
      $('a[title="inloggen"]').hide();
      $('a[title="registreren"]').hide();
    </script>
  <?php
  } else {
  ?>
     <script>
      $('a[title="profiel"]').hide();
      $('a[title="uitloggen"]').hide();
    </script>
  <?php
  }
  ?>
</div><!--end main-warapper-->
</body>
</html>
