<?php $post_id = get_the_id(); ?>

<div class="fl-post-slider-post fl-post-slider-<?php echo $module->get_slider_class( $post_id ) ?><?php if( isset( $settings->show_thumb ) && $settings->show_thumb == 'show' ) echo ' fl-post-slider-has-image'; ?> swiper-slide" itemscope="itemscope" itemtype="<?php FLPostGridModule::schema_itemtype(); ?>">

	<?php 
		
		FLPostGridModule::schema_meta();

		// render featured images
		if( isset( $settings->show_thumb ) && $settings->show_thumb == 'show'){
			if( has_post_thumbnail( $post_id ) ) echo $module->render_mobile_img( $post_id );
			if( has_post_thumbnail( $post_id ) ) echo $module->render_img( $post_id );
		} 
	?>

	<div class="fl-post-slider-content">

		<?php $module->render_post_title( $post_id ) ?>

		<?php if( $settings->show_author || $settings->show_date || $settings->show_comments ) : ?>
		<div class="fl-post-slider-feed-meta">
			<?php if( $settings->show_author ) : ?>
				<span class="fl-post-slider-feed-author">
					<?php

					printf(
						_x( 'By %s', '%s stands for author name.', 'fl-builder' ),
						'<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '"><span>' . get_the_author_meta( 'display_name', get_the_author_meta( 'ID' ) ) . '</span></a>'
					);

					?>
				</span>
			<?php endif; ?>
			<?php if( $settings->show_date ) : ?>
				<?php if( $settings->show_author == 1 ) : ?>
					<span class="fl-sep"> | </span>
				<?php endif; ?>
				<span class="fl-post-slider-feed-date">
					<?php FLBuilderLoop::post_date($settings->date_format); ?>
				</span>
			<?php endif; ?>
			<?php if( $settings->show_comments && comments_open() ) : ?>
				<?php if( $settings->show_author == 1 || $settings->show_date ) : ?>
					<span class="fl-sep"> | </span>
				<?php endif; ?>
				<span class="fl-post-slider-feed-comments">
					<?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?>
				</span>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php if( $settings->show_content || $settings->show_more_link  ) : ?>
		<div class="fl-post-slider-feed-content swiper-no-swiping" itemprop="text">
			<?php if( $settings->show_content ) : ?>
			<?php the_excerpt(); ?>
			<?php endif; ?>
			<?php if( $settings->show_more_link ) : ?>
			<a class="fl-post-slider-feed-more" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $settings->more_link_text; ?></a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		
	</div>

</div>