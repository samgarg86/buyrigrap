<section id="footer">
    <div class="container-fluid black">
    <?php
        wp_nav_menu(array(
            'theme_location' => 'footer_navigation', // menu slug from step 1
            'container' => false, // 'div' container will not be added
            'menu_class' => 'nav', // <ul class="nav">
            'fallback_cb' => false // name of default function from step 2
        ));
    ?>
    </div>
</section>
<?php wp_footer(); ?>
    <script src="/wordpress/wp-content/themes/riprag-theme/assets/js/riprag.js" type="text/javascript"></script>
</body>
</html>
