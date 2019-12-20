
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 footerLogo">
            <img src="<?php echo get_template_directory_uri()?>/img/prettyBougie.png" class="footerImage">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 menu">
            <h4>Menu</h4>
            <?php
              $args = array(
                'theme_location'  => 'header-menu',
                'container' => 'div',
                'container_class' => 'footerMenu',
                'container_id'    => 'footerMenu'
              );
              wp_nav_menu($args);
            ?>
          </div>
          <div class="col-sm-4 menu">
            <h4>Products</h4>
            <?php
              $args = array(
                'theme_location' => 'shop',
                'container' => 'div',
                'container_class' => 'footerMenu',
                'container_id'    => 'footerMenu'
              );
              wp_nav_menu($args);
             ?>
          </div>
          <div class="col-sm-4 menu">
            <h4>Support</h4>
            <?php
              $args = array(
                'theme_location' => 'more',
                'container' => 'div',
                'container_class' => 'footerMenu',
                'container_id'    => 'footerMenu'
              );
              wp_nav_menu($args);
             ?>
          </div>
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
