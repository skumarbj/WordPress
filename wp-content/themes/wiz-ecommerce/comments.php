<?php if ( post_password_required() ) : ?>
	<p><?php esc_attr_e( 'This post is password protected. Enter the password to view any comments.', 'wiz-ecommerce' ); ?></p>
	<?php return; endif; ?>
    <?php if ( have_comments() ) : ?>
	<div class="wiz-comment" id="comments">
	<?php $wiz_ecommerce_num_comments = get_comments_number(); // get_comments_number returns only a numeric value

	if ( $wiz_ecommerce_num_comments == 0 ) {
		$wiz_ecommerce_comments = esc_attr__('No Comments','wiz-ecommerce');
	} elseif ( $wiz_ecommerce_num_comments > 1 ) {
		$wiz_ecommerce_comments = $wiz_ecommerce_num_comments . esc_attr__(' Comments','wiz-ecommerce');
	} else {
		$wiz_ecommerce_comments = esc_attr__('1 Comment','wiz-ecommerce');
	} ?>	
	<h4 class="mb-4"><?php echo esc_attr($wiz_ecommerce_comments); ?></h4>
	<ul class="wiz-comments list-unstyled">
		<?php wp_list_comments( array( 'callback' => 'wiz_ecommerce_comment' ) ); ?>
	</ul>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav class="blog-pagination">
			<div class="row navi">
				<ul class="col-md-12">
					<li class="pull-left"><?php previous_comments_link( __( '&larr; Older Comments', 'wiz-ecommerce' ) ); ?></li>
					<li class="pull-right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wiz-ecommerce' ) ); ?></li>
				</ul>
			</div>
		</nav>
		<?php endif;  ?>
	</div>		
	<?php endif; ?>
	
<?php if ( comments_open() ) : ?>
	<div class="mt-5 wiz-reply">
		<div class="row">
		<div class="col-md-12">
	<?php $wiz_ecommerce_fields=array(
		'author' => '<div class="col-md-6"><div class="form-group"><input name="author" id="name" type="text" class="form-control" placeholder="'. __( 'Name*','wiz-ecommerce').'" required></div></div>',
		'email' => '<div class="col-md-6"><div class="form-group"><input  name="email" id="email" type="text" class="form-control" placeholder="'. __( 'Email*','wiz-ecommerce').'"></div></div>',
	);
	function wiz_ecommerce_comment_fields($wiz_ecommerce_fields) { 
		return $wiz_ecommerce_fields;
	}
	add_filter('wiz_ecommerce_comment_form_default_fields','wiz_ecommerce_comment_fields');
		$wiz_ecommerce_comment_args = array(
		'fields'=> apply_filters( 'wiz_ecommerce_comment_form_default_fields', $wiz_ecommerce_fields ),
		'comment_field'=> '<div class="col-md-12"><div class="form-group"><textarea id="comment" name="comment" class="form-control" rows="5" placeholder="'. __( 'Message*','wiz-ecommerce').'"></textarea></div></div>',		
		'logged_in_as' => '<p class="col-md-12 logged-in-as">' . __( "Logged in as ","wiz-ecommerce" ).'<a href="'. esc_url(admin_url( 'profile.php' )).'">'.$user_identity.'</a>'. '<a href="'. wp_logout_url( get_permalink() ).'" title="'. __('Log out of this account','wiz-ecommerce').'">'.__(" Log out?","wiz-ecommerce").'</a>' . '</p>',
		'title_reply_before' => '<h4 class="mb-4">',
		'title_reply_after' => '</h4>',
		'class_submit' => 'btn btn-green pull-right',
		'class_form' => 'row',
		'comment_notes_before' => '<p class="col-sm-12 comment-notes"><span id="email-notes">'.__('Your email address will not be published.</span> Required fields are marked <span class="required">*</span>','wiz-ecommerce').'</p>',
		'label_submit'=>__( 'Post Comment ','wiz-ecommerce'),
		'title_reply'=> __('Leave A Reply','wiz-ecommerce'),		
		'role_form'=> 'form',		
		);
		comment_form($wiz_ecommerce_comment_args); ?>	
</div>
</div>
</div>
<?php endif; // If registration required and not logged in ?>