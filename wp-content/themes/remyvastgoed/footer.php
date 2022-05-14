  </div>

  <div class="footer">
    <footer>
      <div class="container">
	  
<a href="https://www.facebook.com/remyvastgoed/" target="_blank">
   <p class="kaarticons"><img src="<?php bloginfo( 'template_url' ); ?>/images/facebookfooter.png" title="Facebook" /></p>
</a>
<a href="https://www.instagram.com/remyvastgoed/" target="_blank">
  <p class="kaarticons"><img src="<?php bloginfo( 'template_url' ); ?>/images/instagramfooter.png" title="Instagram" /></p>
</a>
<a href="https://twitter.com/remyvastgoed" target="_blank">
   <p class="kaarticons"><img src="<?php bloginfo( 'template_url' ); ?>/images/twitterfooter.png" title="Twitter" /></p>
</a>


        <p class="terms"><a href="algemenevoorwaarden">Algemene voorwaarden</a> | <a href="disclaimer">Disclaimer</a> | <a href="privacy">Privacybeleid</a></p>
        <p class="copyright">&copy; <?php echo date("Y"); ?> Remy Vastgoed NV. Alle rechten voorbehouden.</p>
        <p></p>

      </div>

    </footer>
  </div>

    
	
  <!-- Don't forget analytics -->
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.magnific-popup.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.drawer.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/jquery.simplemodal.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/main.js?v=202009101309"></script>
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

</body>

</html>
