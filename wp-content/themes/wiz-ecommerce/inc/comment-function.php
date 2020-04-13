<?php 

// code for comment

function wiz_ecommerce_comment( $comment, $args, $depth ) 

{ global $comment_data;

	//translations

	$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : __('Reply','wiz-ecommerce'); ?>

	<li id="comment-<?php echo esc_attr($comment->comment_ID); ?>">
	<div class="comment-box">

		<div class="img-thumbnail p-0">

        <?php echo get_avatar($comment,$size = '80'); ?>

        </div>

       <div class="comment-block">

       	<span class="comment-by">
			<strong><?php comment_author();?></strong>
			<span class="float-right">
				<span> 
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] )) ); ?>
				</span>
			</span>
		</span>
		<p class="m-0"></p>

			<h3><?php comment_text(); ?></h3>
			<?php  if ( $comment->comment_approved == '0' ) : ?>

			<em class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'wiz-ecommerce' ); ?></em>

			<br/>

			<?php endif; ?>

			<span>

			<?php if ( ('d M  y') == get_option( 'date_format' ) ) : ?>				

			<?php comment_date('F j, Y');?>

			<?php else : ?>

			<?php comment_date(); ?>

			<?php endif; ?>

			<?php esc_html_e('at','wiz-ecommerce');?>&nbsp;<?php comment_time('g:i a'); ?></span>

			

			</div>
		</div>
	</li>

<?php

} ?>