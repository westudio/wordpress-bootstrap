  <div id="offcanvas" class="offcanvas">

    <div class="offcanvas-header">
      <button
        class="close offcanvas-close"
        data-toggle="offcanvas"
        data-target="#offcanvas">
        <i class="glyphicon glyphicon-remove"></i>
      </button>
    </div>

    <nav>
      <?php
      wp_nav_menu(array(
        'theme_location' => 'main',
        'menu_class'     => 'nav nav-stacked nav-pills',
      ));
      ?>
    </nav>

  </div><!-- /#offcanvas -->
