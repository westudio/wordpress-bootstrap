<?php

if (!wb_has_layout()):
  return;
endif;

?>
  <footer class="footer">

    <div class="container">

      <p class="credits navbar-left">
        <?php printf(
          '&copy; %s %s',
          get_bloginfo('name'),
          '2015' . (date('Y') === '2015' ? '' : '-' . date('Y'))
        ) ?>
        | <?php printf(
          __('Website by %s', 'wb'),
          '<a href="http://we-studio.ch" target="_blank">We studio</a>'
        ) ?>
      </p>

      <nav class="navbar-right">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer',
          'menu_class'     => 'nav nav-pills',
          'depth'          => 1,
        ));
        ?>
      </nav>

    </div><!-- /container -->

  </footer>

  <?php wp_footer(); ?>

</body>
</html>
