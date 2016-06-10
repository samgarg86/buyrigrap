<section id="footer" class="spacer-upper-30">
    <div class="container-fluid black">
        <div class="row">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_navigation', // menu slug from step 1
                    'container' => false, // 'div' container will not be added
                    'menu_class' => 'nav', // <ul class="nav">
                    'fallback_cb' => false // name of default function from step 2
                ));
            ?>
        </div>
        <div class="row footer-text">
            Outdoor Brands, LLC, PO Box 8464, Jupiter, Florida 33468 USA, 561.200.5958<br>
            &copy;Outdoor Brands, LLC All Rights Reserved
        </div>
    </div>
</section>
<?php wp_footer(); ?>
    <script src="/wordpress/wp-content/themes/riprag-theme/assets/js/riprag.js" type="text/javascript"></script>
</body>
</html>
