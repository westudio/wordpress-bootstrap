        <div class="container">
            <footer>
                <div class="footer-inner">
                    <div class="navbar">
                        <div class="navbar-inner">
                            <a class="btn btn-navbar btn-icon" data-toggle="collapse" data-target="footer .nav-collapse" title="<?php _e('Menu'); ?>" rel="tooltip" data-placement="left"><i class="icon-list icon-white"></i></a>

                            <?php
                            wp_nav_menu(array(
                                'menu'    => 'footer',
                                'menu_id' => 'footer-menu',
                            ));
                            ?>

                        </div>
                    </div>
                </div>
            </footer>
        </div> <!-- /container -->

        <?php wp_footer(); ?>
    </body>
</html>