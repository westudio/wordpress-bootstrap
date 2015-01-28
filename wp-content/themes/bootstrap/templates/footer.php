<?php

if (!bootstrap_has_layout()):
  return;
endif;

?>
  <footer class="navbar navbar-default navbar-fixed-bottom">

    <div class="container">

      <p class="credits small text-muted navbar-text navbar-left">
        <?php printf(
          '&copy; %s %s',
          get_bloginfo('name'),
          '2015' . (date('Y') === '2015' ? '' : '-' . date('Y'))
        ) ?>
        | <?php printf(
          __('Website by %s', 'bootstrap'),
          '<a href="http://we-studio.ch" target="_blank">We studio</a>'
        ) ?>
      </p>

      <nav id="footer-menu" class="collapse navbar-collapse">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer',
          'menu_class'     => 'nav navbar-nav navbar-right',
          'depth'          => 2,
          'dropdown'       => true
        ));
        ?>
      </nav>

    </div><!-- /container -->

  </footer>

  <?php wp_footer(); ?>

</body>
</html>
