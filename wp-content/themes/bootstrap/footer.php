<?php

if (!bootstrap_has_layout()):
    return;
endif;

?>
        <footer id="footer">
            <div class="footer-inner">
                <div class="container">
                    <p class="copyright">&copy; <?php echo get_bloginfo('name'); ?> <?php echo date('Y'); ?></p>
                    <p class="credits"><?php printf(__('Website by %s', 'bootstrap'), '<a href="http://we-studio.ch" target="_blank">We studio</a>') ?></p>
                </div> <!-- /container -->
            </div>
        </footer>

        <?php wp_footer(); ?>

    </body>
</html>