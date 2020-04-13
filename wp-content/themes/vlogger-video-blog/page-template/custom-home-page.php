<?php
/**
 * Template Name: Custom Home
 */
get_header(); ?>

<?php 
  $archive_year  = get_the_time('Y'); 
  $archive_month = get_the_time('m'); 
  $archive_day   = get_the_time('d'); 
?>

<main id="maincontent" role="main">
	<section class="top-video">
		<div class="row">
			<div class="<?php if(get_theme_mod('vlogger_video_blog_top_video_two') || get_theme_mod('vlogger_video_blog_top_video_three')) { ?>col-lg-7 col-md-7 p-0" <?php } else { ?>col-lg-12 col-md-12 <?php } ?>">
				<div class="one">
					<?php if( get_theme_mod( 'vlogger_video_blog_top_video_one') != '') { ?>
			        	<?php $args = array( 'name' => get_theme_mod('vlogger_video_blog_top_video_one',''));
			          	$query = new WP_Query( $args );
			          	if ( $query->have_posts() ) :
			            while ( $query->have_posts() ) : $query->the_post(); ?>
	                		<div class="video-box">
			                  	<?php
				                    $content = apply_filters( 'the_content', get_the_content() );
				                    $video = false;
				                    // Only get video from the content if a playlist isn't present.
				                    if ( false === strpos( $content, 'wp-playlist-script' ) ) {
				                      $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
				                    }
			                  	?>
	                  			<?php
				                    if ( ! is_single() ) {
				                      	// If not a single post, highlight the video file.
				                      	if ( ! empty( $video ) ) {
				                        	foreach ( $video as $video_html ) {
				                          		echo '<div class="entry-video">';
					                            	echo $video_html;
					                          	echo '</div>';
				                        	}
				                      	}
				                      	elseif(has_post_thumbnail()) { 
				                        	the_post_thumbnail(); 
				                      	}
				                    }; 
	                  			?>
	                		</div>
	                		<div class="video-content">
	                			<div class="video-tag">
		                			<?php
					                    if( $tags = get_the_tags() ) {
					                       echo '<span class="meta-sep"></span>';
					                       foreach( $tags as $blog_tag ) {
					                         $sep = ( $blog_tag === end( $tags ) ) ? '' : ' ';
					                         echo '<a class="post-tag" href="' . esc_url(get_term_link( $blog_tag, $blog_tag->taxonomy )) . '">' . esc_html($blog_tag->name) . '</a>' . esc_html($sep);
					                       }
					                    }
					                ?>
					            </div>
		                  		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		                  		<div class="metabox">
					              	<?php if(get_theme_mod('vw_blog_magazine_toggle_postdate',true)==1){ ?>
					                	<span class="entry-date"><i class="far fa-calendar-alt"></i><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>/
					             	<?php } ?>
					              	<?php if(get_theme_mod('vw_blog_magazine_toggle_author',true)==1){ ?>
					                	<span class="entry-author"><i class="fas fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>/
					              	<?php } ?>
					              	<?php if(get_theme_mod('vw_blog_magazine_toggle_comments',true)==1){ ?>
					                	<span class="entry-comments"><i class="fas fa-comments"></i><?php comments_number( __('0 Comments','vlogger-video-blog'), __('0 Comments','vlogger-video-blog'), __('% Comments','vlogger-video-blog') ); ?></span>
					              	<?php } ?>
				            	</div>
	            			</div>
		         		<?php endwhile; 
			          	wp_reset_postdata();?>
			          	<?php else : ?>
			            <div class="no-postfound"></div>
			          	<?php
		        		endif; ?>
				  	<?php }?>
				</div>
			</div>
			<div class="col-lg-5 col-md-5 p-0">
				<div class="two">
					<?php if( get_theme_mod( 'vlogger_video_blog_top_video_two') != '') { ?>
						<?php $args = array( 'name' => get_theme_mod('vlogger_video_blog_top_video_two',''));
						$query = new WP_Query( $args );
						if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post(); ?>
							<div class="video-box">
						      	<?php
						            $content = apply_filters( 'the_content', get_the_content() );
						            $video = false;
						            // Only get video from the content if a playlist isn't present.
						            if ( false === strpos( $content, 'wp-playlist-script' ) ) {
						              $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
						            }
						      	?>
								<?php
						            if ( ! is_single() ) {
						              	// If not a single post, highlight the video file.
						              	if ( ! empty( $video ) ) {
						                	foreach ( $video as $video_html ) {
						                  		echo '<div class="entry-video">';
						                        	echo $video_html;
						                      	echo '</div>';
						                	}
						              	}
						              	elseif(has_post_thumbnail()) { 
						                	the_post_thumbnail(); 
						              	}
						            }; 
								?>
							</div>
							<div class="video-content">
								<div class="video-tag">
		                			<?php
					                    if( $tags = get_the_tags() ) {
					                       echo '<span class="meta-sep"></span>';
					                       foreach( $tags as $blog_tag ) {
					                         $sep = ( $blog_tag === end( $tags ) ) ? '' : ' ';
					                         echo '<a class="post-tag" href="' . esc_url(get_term_link( $blog_tag, $blog_tag->taxonomy )) . '">' . esc_html($blog_tag->name) . '</a>' . esc_html($sep);
					                       }
					                    }
					                ?>
					            </div>
						  		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						  		<div class="metabox">
						          	<?php if(get_theme_mod('vw_blog_magazine_toggle_postdate',true)==1){ ?>
						            	<span class="entry-date"><i class="far fa-calendar-alt"></i><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>/
						         	<?php } ?>
						          	<?php if(get_theme_mod('vw_blog_magazine_toggle_author',true)==1){ ?>
						            	<span class="entry-author"><i class="fas fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>/
						          	<?php } ?>
						          	<?php if(get_theme_mod('vw_blog_magazine_toggle_comments',true)==1){ ?>
						            	<span class="entry-comments"><i class="fas fa-comments"></i><?php comments_number( __('0 Comments','vlogger-video-blog'), __('0 Comments','vlogger-video-blog'), __('% Comments','vlogger-video-blog') ); ?></span>
						          	<?php } ?>
						    	</div>
							</div>
						<?php endwhile; 
						wp_reset_postdata();?>
						<?php else : ?>
						<div class="no-postfound"></div>
						<?php
						endif; ?>
					<?php }?>
				</div>
				<div class="three">
					<?php if( get_theme_mod( 'vlogger_video_blog_top_video_three') != '') { ?>
						<?php $args = array( 'name' => get_theme_mod('vlogger_video_blog_top_video_three',''));
						$query = new WP_Query( $args );
						if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post(); ?>
							<div class="video-box">
						      	<?php
						            $content = apply_filters( 'the_content', get_the_content() );
						            $video = false;
						            // Only get video from the content if a playlist isn't present.
						            if ( false === strpos( $content, 'wp-playlist-script' ) ) {
						              $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
						            }
						      	?>
								<?php
						            if ( ! is_single() ) {
						              	// If not a single post, highlight the video file.
						              	if ( ! empty( $video ) ) {
						                	foreach ( $video as $video_html ) {
						                  		echo '<div class="entry-video">';
						                        	echo $video_html;
						                      	echo '</div>';
						                	}
						              	}
						              	elseif(has_post_thumbnail()) { 
						                	the_post_thumbnail(); 
						              	}
						            }; 
								?>
							</div>
							<div class="video-content">
								<div class="video-tag">
		                			<?php
					                    if( $tags = get_the_tags() ) {
					                       echo '<span class="meta-sep"></span>';
					                       foreach( $tags as $blog_tag ) {
					                         $sep = ( $blog_tag === end( $tags ) ) ? '' : ' ';
					                         echo '<a class="post-tag" href="' . esc_url(get_term_link( $blog_tag, $blog_tag->taxonomy )) . '">' . esc_html($blog_tag->name) . '</a>' . esc_html($sep);
					                       }
					                    }
					                ?>
					            </div>
						  		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						  		<div class="metabox">
						          	<?php if(get_theme_mod('vw_blog_magazine_toggle_postdate',true)==1){ ?>
						            	<span class="entry-date"><i class="far fa-calendar-alt"></i><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>/
						         	<?php } ?>
						          	<?php if(get_theme_mod('vw_blog_magazine_toggle_author',true)==1){ ?>
						            	<span class="entry-author"><i class="fas fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>/
						          	<?php } ?>
						          	<?php if(get_theme_mod('vw_blog_magazine_toggle_comments',true)==1){ ?>
						            	<span class="entry-comments"><i class="fas fa-comments"></i><?php comments_number( __('0 Comments','vlogger-video-blog'), __('0 Comments','vlogger-video-blog'), __('% Comments','vlogger-video-blog') ); ?></span>
						          	<?php } ?>
						    	</div>
							</div>
						<?php endwhile; 
						wp_reset_postdata();?>
						<?php else : ?>
						<div class="no-postfound"></div>
						<?php
						endif; ?>
					<?php }?>
				</div>
			</div>
		</div>
	</section>

	<?php if( get_theme_mod('vlogger_video_blog_about') != '' || get_theme_mod('vlogger_video_blog_playlist') != '' ){ ?>
		<section id="playlist_sec">
			<div class="container">
				<div class="row">
					<div class="<?php if(get_theme_mod('vlogger_video_blog_playlist')) { ?>col-lg-4 col-md-4" <?php } else { ?>col-lg-12 col-md-12 text-center <?php } ?>">
						<?php $about_pages = array();
				      		$mod = absint( get_theme_mod( 'vlogger_video_blog_about','vlogger-video-blog'));
					        if ( 'page-none-selected' != $mod ) {
				            	$about_pages[] = $mod;
					        }
				          	if( !empty($about_pages) ) :
				            $args = array(
								'post_type' => 'page',
								'post__in' => $about_pages,
								'orderby' => 'post__in'
				            );
				            $query = new WP_Query( $args );
				            if ( $query->have_posts() ) :
				              	$count = 0;
				              	while ( $query->have_posts() ) : $query->the_post(); ?>
					                <h3><?php the_title(); ?></h3>
					                <p><?php the_excerpt(); ?></p>
					                <div class="more-btn">
					                	<a href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'VIEW ALL', 'vlogger-video-blog' ); ?><span class="screen-reader-text"><?php esc_html_e( 'VIEW ALL','vlogger-video-blog' );?></span></a>
					                </div>
				              	<?php $count++; endwhile; ?>
				            <?php else : ?>
				          		<div class="no-postfound"></div>
				            <?php endif;
			          		endif;
			          		wp_reset_postdata();
			        	?>
					</div>
					<div class="<?php if(get_theme_mod('vlogger_video_blog_about')) { ?>col-lg-8 col-md-8" <?php } else { ?>col-lg-12 col-md-12 <?php } ?>">
				    	<div class="row">
				    		<div class="owl-carousel">
					      		<?php
					      		$catData2=  get_theme_mod('vlogger_video_blog_playlist');if($catData2){ 
					      		$page_query = new WP_Query(array( 'category_name' => esc_html($catData2 ,'vlogger-video-blog')));?>
					        	<?php while( $page_query->have_posts() ) : $page_query->the_post(); ?> 
					          		<div class="playlist-video">
								      	<?php
								            $content = apply_filters( 'the_content', get_the_content() );
								            $video = false;
								            // Only get video from the content if a playlist isn't present.
								            if ( false === strpos( $content, 'wp-playlist-script' ) ) {
								              $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
								            }
								      	?>
										<?php
								            if ( ! is_single() ) {
								              	// If not a single post, highlight the video file.
								              	if ( ! empty( $video ) ) {
								                	foreach ( $video as $video_html ) {
								                  		echo '<div class="entry-video">';
								                        	echo $video_html;
								                      	echo '</div>';
								                	}
								              	}
								              	elseif(has_post_thumbnail()) { 
								                	the_post_thumbnail(); 
								              	}
								            }; 
										?>
							          	<div class="playlist-box">
							          		<div class="playlist-tag">
					                			<?php
								                    if( $tags = get_the_tags() ) {
								                       echo '<span class="meta-sep"></span>';
								                       foreach( $tags as $blog_tag ) {
								                         $sep = ( $blog_tag === end( $tags ) ) ? '' : ' ';
								                         echo '<a class="post-tag" href="' . esc_url(get_term_link( $blog_tag, $blog_tag->taxonomy )) . '">' . esc_html($blog_tag->name) . '</a>' . esc_html($sep);
								                        }
								                    }
								                ?>
								            </div>
							            	<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
							            	<div class="metabox">
									            <?php if(get_theme_mod('vw_blog_magazine_toggle_postdate',true)==1){ ?>
									                <span class="entry-date"><i class="far fa-calendar-alt"></i><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
									            <?php } ?>
									            <?php if(get_theme_mod('vw_blog_magazine_toggle_author',true)==1){ ?>
									                <span class="entry-author"><i class="fas fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
									            <?php } ?>
									            <?php if(get_theme_mod('vw_blog_magazine_toggle_comments',true)==1){ ?>
									                <span class="entry-comments"><i class="fas fa-comments"></i><?php comments_number( __('0 Comments','vlogger-video-blog'), __('0 Comments','vlogger-video-blog'), __('% Comments','vlogger-video-blog') ); ?></span>
									            <?php } ?>
	        								</div>
	        							</div>
								  	</div>
					          		<?php endwhile; 
					          	wp_reset_postdata();
					      		}?>
				      		</div>
				      	</div>
					</div>
				</div>
			</div>
		</section>
	<?php }?>

	<?php if( get_theme_mod('vw_blog_magazine_category') != ''){ ?>
		<section id="categry">
			<div class="container">
				<?php if( get_theme_mod( 'vlogger_video_blog_section_title') != '') { ?>              
              		<h3><?php echo esc_html(get_theme_mod('vlogger_video_blog_section_title',''));?></h3>
      			<?php } ?>
				<div class="owl-carousel">
				  	<?php 
				  	$catData1=  get_theme_mod('vw_blog_magazine_category');if($catData1){
				    $page_query = new WP_Query(array( 'category_name' => esc_html($catData1 ,'vw-blog-magazine')));?>
				    <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
			        <div class="imagebox">
			        	<?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
			        	<div class="cat-tag">
				        	<?php
			                    if( $tags = get_the_tags() ) {
			                       echo '<span class="meta-sep"></span>';
			                       foreach( $tags as $blog_tag ) {
			                         $sep = ( $blog_tag === end( $tags ) ) ? '' : ' ';
			                         echo '<a class="post-tag" href="' . esc_url(get_term_link( $blog_tag, $blog_tag->taxonomy )) . '">' . esc_html($blog_tag->name) . '</a>' . esc_html($sep);
			                       }
			                    }
			                ?>
				        	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h4>
			        	</div>
			        </div>
				      <?php endwhile; 
				      wp_reset_postdata();
				  	}?>	
			  	</div>
			</div>
		</section>
	<?php }?>

	<?php if( get_theme_mod('vw_blog_magazine_section_two') != ''){ ?>
		<section id="our_blog">
			<div class="container">
			  	<div class="row">
				    <div class="col-lg-9 col-md-9">
				    	<div class="row">
				      		<?php
				      		$catData2=  get_theme_mod('vw_blog_magazine_section_two');if($catData2){ 
				      		$page_query = new WP_Query(array( 'category_name' => esc_html($catData2 ,'vlogger-video-blog')));?>
				        	<?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>     	
					          	<div class="col-lg-6 col-md-12">
					          		<div class="postbox smallpostimage">
								      	<?php 
								          if(has_post_thumbnail()) { ?>
									        <div class="padd-box">
									          	<div class="box-image">
									            	<?php the_post_thumbnail();  ?>
									            	<div class="overlay">
									              		<div class="text"><i class="fas fa-camera"></i></div>
									            	</div>
									          	</div>
									        </div>
								      	<?php } ?>
								      	<div class="new-text">			          	
								          	<div class="box-content">
								            	<h3><?php the_title();?></h3>
								            	<div class="metabox">
										            <?php if(get_theme_mod('vw_blog_magazine_toggle_postdate',true)==1){ ?>
										                <span class="entry-date"><i class="far fa-calendar-alt"></i><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
										            <?php } ?>

										            <?php if(get_theme_mod('vw_blog_magazine_toggle_author',true)==1){ ?>
										                <span class="entry-author"><i class="fas fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
										            <?php } ?>

										            <?php if(get_theme_mod('vw_blog_magazine_toggle_comments',true)==1){ ?>
										                <span class="entry-comments"><i class="fas fa-comments"></i><?php comments_number( __('0 Comments','vlogger-video-blog'), __('0 Comments','vlogger-video-blog'), __('% Comments','vlogger-video-blog') ); ?></span>
										            <?php } ?>
		        								</div>
									            <hr class="big">
									            <hr class="small"><p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_blog_magazine_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_blog_magazine_category_excerpt_number','30')))); ?></p>
									            <div class="read-btn">
									              	<a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read Full', 'vlogger-video-blog' ); ?>"><?php esc_html_e('Read Full','vlogger-video-blog'); ?><span class="screen-reader-text"><?php esc_html_e( 'Read Full','vlogger-video-blog' );?></span></a>
									            </div>
								          	</div>
								      	</div>
								      	<div class="clearfix"></div> 
								  	</div>
					          	</div>	          	
				          		<?php endwhile; 
				          	wp_reset_postdata();
				      		}?>
				      	</div>
				    </div>
				    <div class="col-lg-3 col-md-3">
			      		<div class="sidebar"><?php dynamic_sidebar('home'); ?></div>
				    </div>
				</div>
			</div>
		</section>
	<?php }?>

	<div class="content-vw">
		<div class="container">
		 	<?php while ( have_posts() ) : the_post(); ?>
		        <?php the_content(); ?>
		    <?php endwhile; // end of the loop. ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>