<?php get_header(); ?>
<div class="overlay" id="main">
  <?php while(have_posts()): the_post(); ?>
    <div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url();?>)">
      <div class="hero-content animated fadeInDown">
        <div class="container">
          <div class=" row">
            <div class="col-6">
              <h2 class="home-text"><?php echo esc_html( get_option('blogdescription'))?></h2>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <h3 class="colorChange"><?php the_content(); ?></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <?php $url = get_page_by_title('Shop'); ?>
              <a class="button" href="<?php echo get_permalink($url->ID); ?>">Shop</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main-content container">
      <main class="content-text clear" data-aos="fade-up" data-aos-delay="100" data-aos-once="true" data-aos-easing="ease-in-out">
        <h2 class="primary-text text-center">Shop</h2>
        <div class="row padding">
          <div class="col-md-4 shop-content">
            <div>
              <img class="shopImg" src="<?php echo get_template_directory_uri()?>/img/shop1.jpg">
            </div>
            <div class="information">
              <h3>Bundles</h3>
            </div>
          </div>
          <div class="col-md-4 shop-content">
            <div>
              <img class="shopImg" src="<?php echo get_template_directory_uri()?>/img/shop2.jpg">
            </div>
            <div class="information">
              <h3>Closures & Frontals</h3>
            </div>
          </div>
          <div class="col-md-4 shop-content">
            <div>
              <img class="shopImg" src="<?php echo get_template_directory_uri()?>/img/shop3.jpg">
            </div>
            <div class="information">
              <h3>Lace Wigs</h3>
            </div>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
      </main>
    </div>
    <section class="video">
      <div class="row">
        <?php while(have_posts()): the_post(); ?>
          <div class="col-md-6 home-title" data-aos="fade-in" data-aos-offset="200" data-aos-delay="400" data-aos-once="true" data-aos-easing="ease-in-out">
            <h3><?php the_field('sub_title_2');?></h3>
          </div>
          <div class="col-md-6 home-video">
            <video playsinline="playsinline" autoplay="autoplay" loop muted>
              <source src="<?php echo get_template_directory_uri()?>/img/video.mp4" type="video/mp4">
            </video>
          </div>
          <?php endwhile; ?>
      </div>
    </section>
    <section class="home-products">
      <div class="container">
        <?php echo do_shortcode('[products limit="3" columns="3" category="Bundles" cat_operator="AND"]');?>
      </div>
    </section>
    <section class="second-section">
          <div class="row">
            <?php while(have_posts()): the_post(); ?>
              <div class="col-md-6 care-tips">
                <h3 data-aos="fade-in" data-aos-offset="200" data-aos-delay="400" data-aos-once="true" data-aos-easing="ease-in-out"><?php the_field('sub_title'); ?></h3>
                <div data-aos="fade-in" data-aos-offset="200" data-aos-delay="500" data-aos-once="true" data-aos-easing="ease-in-out">
                  <?php the_field('sub_text'); ?>
                </div>
                <?php $url = get_page_by_title('Hair Care Tips'); ?>
                <a href="<?php echo get_permalink($url->ID);?>">Learn More</a>
              </div>
              <div class="col-md-6 about">
                <?php $url = get_page_by_title('About Us'); ?>
                <a class="button2" href="<?php echo get_permalink($url->ID); ?>">Lear More About Us</a>
              </div>
            <?php endwhile; ?>
          </div>
    </section>
</div>

<?php get_footer(); ?>
