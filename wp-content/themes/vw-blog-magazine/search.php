<?php
/**
 * The template for displaying Search Results pages.
 *
 *
 * @package VW Blog Magazine
 */

get_header(); ?>


<main id="maincontent" class="middle-align" role="main">
    <div class="container">
        <?php
        $theme_lay = get_theme_mod( 'vw_blog_magazine_theme_options','Right Sidebar');
        if($theme_lay == 'Left Sidebar'){ ?>
            <div class="row">
                <div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1');?></div>
                <div id="our-services" class="services col-lg-9 col-md-9">
                    <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-blog-magazine'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
                    <?php if ( have_posts() ) :
                        /* Start the Loop */
                      
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content',get_post_format()); 
                      
                        endwhile;

                        else :

                            get_template_part( 'no-results' ); 

                        endif; 
                    ?>
                    <div class="navigation">
                        <?php
                            // Previous/next page navigation.
                            the_posts_pagination( array(
                                'prev_text'          => __( 'Previous page', 'vw-blog-magazine' ),
                                'next_text'          => __( 'Next page', 'vw-blog-magazine' ),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-blog-magazine' ) . ' </span>',
                            ) );
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php }else if($theme_lay == 'Right Sidebar'){ ?>
            <div class="row">
                <div id="our-services" class="services col-lg-9 col-md-9"> 
                    <h1 class="entry-title"><?php printf( esc_html( 'Results For: %s','vw-blog-magazine'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
                    <?php if ( have_posts() ) :
                    /* Start the Loop */
                      
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content',get_post_format()); 
                      
                        endwhile;

                        else :

                            get_template_part( 'no-results' ); 

                        endif; 
                    ?>
                    <div class="navigation">
                        <?php
                            // Previous/next page navigation.
                            the_posts_pagination( array(
                                'prev_text'          => __( 'Previous page', 'vw-blog-magazine' ),
                                'next_text'          => __( 'Next page', 'vw-blog-magazine' ),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-blog-magazine' ) . ' </span>',
                            ) );
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1');?></div>
            </div>
        <?php }else if($theme_lay == 'One Column'){ ?>
            <div id="our-services" class="services">
                <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-blog-magazine'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
                <?php if ( have_posts() ) :
                /* Start the Loop */
                  
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content',get_post_format()); 
                  
                    endwhile;

                    else :

                        get_template_part( 'no-results' ); 

                    endif; 
                ?>
                <div class="navigation">
                    <?php
                        // Previous/next page navigation.
                        the_posts_pagination( array(
                            'prev_text'          => __( 'Previous page', 'vw-blog-magazine' ),
                            'next_text'          => __( 'Next page', 'vw-blog-magazine' ),
                            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-blog-magazine' ) . ' </span>',
                        ) );
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        <?php }else if($theme_lay == 'Three Columns'){ ?>
            <div class="row">
                <div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1');?></div>
                <div id="our-services" class="services col-lg-6 col-md-6">
                     <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-blog-magazine'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
                    <?php if ( have_posts() ) :
                    /* Start the Loop */
                      
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content',get_post_format()); 
                      
                        endwhile;

                        else :

                            get_template_part( 'no-results' ); 

                        endif; 
                    ?>
                    <div class="navigation">
                        <?php
                            // Previous/next page navigation.
                            the_posts_pagination( array(
                                'prev_text'          => __( 'Previous page', 'vw-blog-magazine' ),
                                'next_text'          => __( 'Next page', 'vw-blog-magazine' ),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-blog-magazine' ) . ' </span>',
                            ) );
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2');?></div>
            </div>
        <?php }else if($theme_lay == 'Four Columns'){ ?>
            <div class="row">
                <div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1');?></div>
                <div id="our-services" class="services col-lg-3 col-md-3">
                     <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-blog-magazine'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
                    <?php if ( have_posts() ) :
                    /* Start the Loop */
                      
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content',get_post_format()); 
                      
                        endwhile;

                        else :

                            get_template_part( 'no-results' ); 

                        endif; 
                    ?>
                    <div class="navigation">
                        <?php
                            // Previous/next page navigation.
                            the_posts_pagination( array(
                                'prev_text'          => __( 'Previous page', 'vw-blog-magazine' ),
                                'next_text'          => __( 'Next page', 'vw-blog-magazine' ),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-blog-magazine' ) . ' </span>',
                            ) );
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-2');?></div>
                <div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-3');?></div>
            </div>
        <?php }else if($theme_lay == 'Grid Layout'){ ?>
            <div class="row">
                <div id="our-services" class="services col-lg-9 col-md-9">
                    <h1 class="entry-title"><?php printf( esc_html( 'Results For: %s','vw-blog-magazine'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
                    <div class="row">
                        <?php if ( have_posts() ) :
                        /* Start the Loop */
                          
                            while ( have_posts() ) : the_post();

                                get_template_part( 'template-parts/grid-layout' ); 
                          
                            endwhile;

                            else :

                                get_template_part( 'no-results' ); 

                            endif; 
                        ?>
                    </div>
                    <div class="navigation">
                        <?php
                            // Previous/next page navigation.
                            the_posts_pagination( array(
                                'prev_text'          => __( 'Previous page', 'vw-blog-magazine' ),
                                'next_text'          => __( 'Next page', 'vw-blog-magazine' ),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-blog-magazine' ) . ' </span>',
                            ) );
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1');?></div>
            </div>
        <?php }else {?>
            <div class="row">
                <div id="our-services" class="services col-lg-9 col-md-9"> 
                     <h1 class="entry-title"><?php /* translators: %s: search term */ printf( esc_html__( 'Results For: %s','vw-blog-magazine'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
                    <?php if ( have_posts() ) :
                    /* Start the Loop */
                      
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content',get_post_format()); 
                      
                        endwhile;

                        else :

                            get_template_part( 'no-results' ); 

                        endif; 
                    ?>
                    <div class="navigation">
                        <?php
                            // Previous/next page navigation.
                            the_posts_pagination( array(
                                'prev_text'          => __( 'Previous page', 'vw-blog-magazine' ),
                                'next_text'          => __( 'Next page', 'vw-blog-magazine' ),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-blog-magazine' ) . ' </span>',
                            ) );
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="sidebar col-lg-3 col-md-3"><?php dynamic_sidebar('sidebar-1');?></div>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</main>

<?php get_footer(); ?>