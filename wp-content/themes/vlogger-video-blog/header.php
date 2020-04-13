<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content-vw">
 *
 * @package Vlogger Video Blog
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'vlogger-video-blog' ) ); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
  wp_body_open();
} else {
  do_action( 'wp_body_open' );
} ?>

<header role="banner">
  <a class="screen-reader-text skip-link" href="#maincontent"><?php esc_html_e( 'Skip to content', 'vlogger-video-blog' ); ?></a>
  <div id="header">
    <div class="header-menu <?php if( get_theme_mod( 'vw_blog_magazine_sticky_header') != '') { ?> header-sticky"<?php } else { ?>close-sticky <?php } ?>">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4">
            <div class="logo">
              <?php if ( has_custom_logo() ) : ?>
                <div class="site-logo"><?php the_custom_logo(); ?></div>
              <?php endif; ?>
              <?php $blog_info = get_bloginfo( 'name' ); ?>
                <?php if ( ! empty( $blog_info ) ) : ?>
                  <?php if ( is_front_page() && is_home() ) : ?>
                  <?php if( get_theme_mod('vw_blog_magazine_logo_title_hide_show',true) != ''){ ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                  <?php } ?>
                  <?php else : ?>
                    <?php if( get_theme_mod('vw_blog_magazine_logo_title_hide_show',true) != ''){ ?>
                      <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php }?>
                  <?php endif; ?>
                <?php endif; ?>
                <?php
                  $description = get_bloginfo( 'description', 'display' );
                  if ( $description || is_customize_preview() ) :
                ?>
                <?php if( get_theme_mod('vw_blog_magazine_tagline_hide_show',true) != ''){ ?>
                  <p class="site-description">
                    <?php echo esc_html( $description ); ?>
                  </p>
                <?php }?>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-lg-6 col-md-4 col-3">
            <div class="toggle-nav mobile-menu">
              <button onclick="vw_blog_magazine_menu_open_nav()" class="mobiletoggle"><i class="<?php echo esc_attr(get_theme_mod('vw_blog_magazine_res_menu_open_icon','fas fa-bars')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Open Button','vlogger-video-blog'); ?></span></button>
            </div>
            <div id="mySidenav" class="nav sidenav">
              <div class="testing">
                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'vlogger-video-blog' ); ?>">
                  <?php
                    wp_nav_menu( array(
                      'theme_location' => 'primary',
                      'container_class' => 'main-menu clearfix' ,
                      'menu_class' => 'clearfix',
                      'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                      'fallback_cb' => 'wp_page_menu',
                    ) );
                  ?>
                  <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="vw_blog_magazine_menu_close_nav()"><i class="<?php echo esc_attr(get_theme_mod('vw_blog_magazine_res_close_menu_icon','fas fa-times')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Button','vlogger-video-blog'); ?></span></a>
                </nav>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-9">
            <div class="search-box">
              <?php get_search_form(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<?php if(get_theme_mod('vw_blog_magazine_loader_enable',true)==1){ ?>
  <div id="preloader">
    <div id="status">
      <?php $theme_lay = get_theme_mod( 'vw_blog_magazine_loader_icon','Two Way');
        if($theme_lay == 'Two Way'){ ?>
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/two-way.gif" alt="" role="img"/>
      <?php }else if($theme_lay == 'Dots'){ ?>
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/dots.gif" alt="" role="img"/>
      <?php }else if($theme_lay == 'Rotate'){ ?>
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/rotate.gif" alt="" role="img"/>
      <?php } ?>
    </div>
  </div>
<?php } ?>
