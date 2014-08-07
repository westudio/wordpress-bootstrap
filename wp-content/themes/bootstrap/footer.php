<?php

if (!bootstrap_has_layout()):
  return;
endif;

?>
  <footer class="layout-footer">
      <div class="container">

        <div class="row">
          <div class="col-sm-6">
            <p class="copyright"><?php printf(
              '&copy; %s %s',
              get_bloginfo('name'),
              date('Y')
            ) ?></p>
          </div>
          <div class="col-sm-6">
            <p class="credits"><?php printf(
              __('Website by %s', 'bootstrap'),
              '<a href="http://we-studio.ch" target="_blank">We studio</a>'
            ) ?></p>
          </div>
        </div>

      </div> <!-- /container -->
  </footer>

  <?php wp_footer(); ?>

</body>
</html>