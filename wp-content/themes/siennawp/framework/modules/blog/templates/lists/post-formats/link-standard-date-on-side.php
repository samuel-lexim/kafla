<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>">
		<div class="mkdf-post-content clearfix">
			<div class="mkdf-post-text">
				<div class="mkdf-post-text-inner">
					<div class="mkdf-post-mark">
						<?php echo sienna_mikado_icon_collections()->renderIcon('icon_link', 'font_elegant'); ?>
					</div>
					<h4 class="mkdf-post-title"><?php the_title(); ?></h4>
				</div>
			</div>
		</div>
	</a>
</article>