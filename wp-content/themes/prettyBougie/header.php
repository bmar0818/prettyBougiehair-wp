<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Pretty Bougie Hair</title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div class="fixed-top">
      <header class="site-header">
         <div class="socialMenu">
           <?php
             $args = array(
               'theme_location' => 'social-menu',
               'conatainer'     => 'div',
               'container_class' => 'socials',
               'container_id'   =>  'socials',
               'link_before'   =>   '<span class="sr-text">',
               'link_after'    =>   '</span>'
             );
             wp_nav_menu($args);
            ?>
         </div>
         <!--<nav class="navbar navbar-expand-md navbar-light fixed-top main-menu" >
             <a class="navbar-brand" href="#">
               <img src="<?php echo get_template_directory_uri()?>/img/prettyBougie.png" class="logoImage img-fluid">
             </a>
             <button class="navbar-toggler btn btn-info" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
               <div class="menu-button"></div>
               <span></span>
             </button>
               <?php
                 wp_nav_menu([
                   'menu'            => 'primary',
                   'theme_location'  => 'header-menu',
                   'container'       => 'div',
                   'container_id'    => 'navbarCollapse',
                   'container_class' => 'collapse navbar-collapse',
                   'menu_id'         => false,
                   'menu_class'      => 'navbar-nav mr-auto',
                   'depth'           => 0,
                   'fallback_cb'     => 'bs4navwalker::fallback',
                   'walker'          => new bs4navwalker()
                 ]);
               ?>
       </nav>-->
     </header>
     <div class="main-menu">
       <div class="row">
         <div class="logo">
           <div class="container-fluid">
             <img src="<?php echo get_template_directory_uri() ?>/img/prettyBougie.png" class="img-fluid">
           </div>
         </div>
         <div class=" navigation">
           <div class="mobile-menu" >
             <a href="#" class="mobile"></a>
           </div>
           <nav class="topnav" id="Topnav">
             <a href="javascript:void(0)" class="closebtn">&times;</a>
             <?php
               $args = array (
                 'menu'            => 'primary',
                 'theme_location'  => 'header-menu',
                 'container'       => 'div',
                 'container_class' => 'site-nav',
               );
               wp_nav_menu($args);
             ?>
           </nav>
         </div>
         </div>
       </div>
    </div>
